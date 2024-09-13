<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillabe=['name','price','quantity'];
    protected $guarded=['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
