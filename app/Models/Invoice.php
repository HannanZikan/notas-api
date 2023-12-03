<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
