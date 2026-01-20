<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//total = volume * amount
class Budget extends Model
{
    protected $fillable = [
        'id_budget', 'detail', 'volume', 'unit', 'amount', 'total'
    ];

    // Accessor untuk format Rupiah pada Harga Satuan
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    // Accessor untuk format Rupiah pada Total
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

}
