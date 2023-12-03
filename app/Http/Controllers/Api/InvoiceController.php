<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreInvoiceRequest;
use App\Http\Requests\Api\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Services\CnpjService;
use Exception;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::query()
                           ->where(
                               'user_id', auth()->id()
                           )
                           ->get()
                           ->toArray();

        return response()->json([
                                    'invoices' => $invoices,
                                ], 200);
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
                                              'sender_cnpj'  => $data['sender_cnpj'],
                                              'sender_name'  => $data['sender_name'],
                                              'carrier_cnpj' => $data['carrier_cnpj'],
                                              'carrier_name' => $data['carrier_name'],
                                          ]);
        } catch (Exception $e) {
            return response()->json([
                                        'message' => $e->getMessage(),
                                    ], $e->getCode());
        }

        return response()->json([
                                    'invoice' => $newInvoice,
                                ], 200);
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return response()->json([
                                    'invoice' => $invoice,
                                ]);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        $data = $request->validated();
        if (!CnpjService::validateCnpj($data['sender_cnpj']) && !CnpjService::validateCnpj($data['carrier_cnpj'])) {
            return response()->json([
                                        'message' => 'Cnpj inválido!',
                                    ]);
        }
        try {
            $invoice->update([
                                 'order_number' => $data['order_number'] ?? $invoice->order_number,
                                 'amount'       => $data['amount'] ?? $invoice->amount,
                                 'issue_date'   => $data['issue_date'] ?? $invoice->issue_date,
                                 'sender_cnpj'  => $data['sender_cnpj'] ?? $invoice->sender_cnpj,
                                 'sender_name'  => $data['sender_name'] ?? $invoice->sender_name,
                                 'carrier_cnpj' => $data['carrier_cnpj'] ?? $invoice->carrier_cnpj,
                                 'carrier_name' => $data['carrier_name'] ?? $invoice->carrier_name,
                             ]);
        } catch (Exception $e) {
            return response()->json([
                                        'message' => $e->getMessage(),
                                    ], $e->getCode());
        }

        return response()->json([
                                    'invoice' => $invoice,
                                ], 200);
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
