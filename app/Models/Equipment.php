<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'name',
        'category',
        'total_quantity',
        'available_quantity',
    ];

    protected $casts = [
        'total_quantity' => 'integer',
        'available_quantity' => 'integer',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}