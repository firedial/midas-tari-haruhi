<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'item',
        'before_id',
        'after_id',
        'date',
    ];
}
