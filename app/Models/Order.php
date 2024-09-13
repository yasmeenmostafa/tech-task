<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'amount', 'user_id', 'payment_intent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
