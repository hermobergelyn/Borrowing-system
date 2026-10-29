<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingTransaction extends Model
{
    use HasFactory;

    // Gitakda nato ang exact table name sa database
    protected $table = 'borrowing_transactions';

    // Ang mga fields nga pwede ma-fill o ma-save gamit ang mass assignment
    protected $fillable = [
        'user_id',
        'equipment_id',
        'quantity',
        'borrowed_date',
        'due_date',
        'returned_date',
        'status',
    ];
}