<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundraisingWithDrawal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'fundraising_id',
        'fundraiser_id',
        'has_received',
        'has_sent',
        'amount_requested',
        'proof',
        'amount_received',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
    ];

    /**
     * Get the fundraiser that owns the FundraisingWithDrawal
     *
     * @return BelongsTo
     */
    public function fundraiser(): BelongsTo
    {
        return $this->belongsTo(Fundraiser::class);
    }

    /**
     * Get the fundraising that owns the FundraisingWithDrawal
     *
     * @return BelongsTo
     */
    public function fundraising(): BelongsTo
    {
        return $this->belongsTo(Fundraising::class);
    }
}