<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'user_id',
        'equipment_id',
        'quantity',
        'status',
        'borrowed_date',
        'borrowed_at',
        'returned_date',
        'returned_at',
    ];

    protected $casts = [
        'borrowed_date' => 'date',
        'borrowed_at' => 'datetime',
        'returned_date' => 'date',
        'returned_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Borrower
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Equipment
    |--------------------------------------------------------------------------
    */

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}