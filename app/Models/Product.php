<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'created_by',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
