<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donatur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'name',
        'notes',
        'phone_number',
        'fundraising_id',
        'total_amount',
        'is_paid',
        'proof',
    ];

    /**
     * Get the fundraising that owns the Donatur
     *
     * @return BelongsTo
     */
    public function fundraising(): BelongsTo
    {
        return $this->belongsTo(Fundraising::class);
    }
}