<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'transaction_date',
        'amount',
    ];

    //Get the client of the transaction
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
