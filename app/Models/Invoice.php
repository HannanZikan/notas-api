<?php

namespace App\Models;

use Alvarofpp\Masks\Traits\MaskAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, MaskAttributes;

    protected $fillable = [
        'id',
        'user_id',
        'order_number',
        'amount',
        'issue_date',
        'sender_cnpj',
        'sender_name',
        'carrier_cnpj',
        'carrier_name',
    ];
    protected $date = [
        'issue_date',
    ];

    protected $maskSuffix = '_formatted';
    protected $masks = [
        'sender_cnpj' => '##.###.###/####-##',
        'carrier_cnpj' => '##.###.###/####-##',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
