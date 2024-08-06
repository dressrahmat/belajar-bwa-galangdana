<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donatur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'name',
        'notes',
        'fundraising_id',
        'total_amount',
        'is_paid',
        'proof',
    ];
}