<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreInvoiceRequest;
use App\Http\Requests\Api\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Policies\Api\InvoicePolicy;
use App\Services\CnpjService;
use Exception;
use App\Notifications\InvoiceCreated;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::query()
                           ->with('user')
                           ->where(
                               'user_id', auth()->id()
                           )
                           ->get();

        return InvoiceResource::collection($invoices);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();
        if (!CnpjService::validateCnpj($data['sender_cnpj']) && !CnpjService::validateCnpj($data['carrier_cnpj'])) {
            return response()->json([
                                        'message' => 'Cnpj inválido!',
                                    ]);
        }
        try {
            $newInvoice = Invoice::create([
                                              'user_id'      => auth()->id(),
                                              'order_number' => $data['order_number'],
                                              'amount'       => $data['amount'],
                                              'issue_date'   => $data['issue_date'],
                                              'sender_cnpj'  => str_replace(['.', '/', '-'], '', $data['sender_cnpj']),
                                              'sender_name'  => $data['sender_name'],
                                              'carrier_cnpj' => str_replace(['.', '/', '-'], '', $data['carrier_cnpj']),
                                              'carrier_name' => $data['carrier_name'],
                                          ]);
        } catch (Exception $e) {
            dd($e->getMessage());

            return response()->json([
                                        'message' => $e->getMessage(),
                                    ], $e->getCode());
        }

        return new InvoiceResource($newInvoice);
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return new InvoiceResource($invoice->load('user'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        $data = $request->validated();
        if (isset($data['sender_cnpj'])) {
            if (!CnpjService::validateCnpj($data['sender_cnpj'])) {
                return response()->json([
                                            'message' => 'Cnpj inválido!',
                                        ]);
            }
        }
        if (isset($data['carrier_cnpj'])) {
            if (!CnpjService::validateCnpj($data['carrier_cnpj'])) {
                return response()->json([
                                            'message' => 'Cnpj inválido!',
                                        ]);
            }
        }
        try {
            $invoice->update([
                                 'order_number' => $data['order_number'] ?? $invoice->order_number,
                                 'amount'       => $data['amount'] ?? $invoice->amount,
                                 'issue_date'   => $data['issue_date'] ?? $invoice->issue_date,
                                 'sender_cnpj'  => str_replace(['.', '/', '-'], '', $data['sender_cnpj']) ?? $invoice->sender_cnpj,
                                 'sender_name'  => $data['sender_name'] ?? $invoice->sender_name,
                                 'carrier_cnpj' => str_replace(['.', '/', '-'], '', $data['carrier_cnpj']) ?? $invoice->carrier_cnpj,
                                 'carrier_name' => $data['carrier_name'] ?? $invoice->carrier_name,
                             ]);
        } catch (Exception $e) {
            return response()->json([
                                        'message' => $e->getMessage(),
                                    ], $e->getCode());
        }

        return new InvoiceResource($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);
        try {
            $invoice->delete();
        } catch (Exception $e) {
            return response()->json([
                                        'message' => $e->getMessage(),
                                    ], $e->getCode());
        }

        return response()->json([
                                    'message' => 'Excluído com sucesso!',
                                ], 200);
    }
}
