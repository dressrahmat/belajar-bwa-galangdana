<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fundraiser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'is_active',
        'user_id',
    ];
}