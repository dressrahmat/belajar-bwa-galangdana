<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fundraising extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'name',
        'slug',
        'fundraiser_id',
        'category_id',
        'thumbnail',
        'about',
        'has_finished',
        'is_active',
        'target_amount',
    ];

    /**
     * Get the category that owns the Fundraising
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the fundraiser that owns the Fundraising
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fundraiser(): BelongsTo
    {
        return $this->belongsTo(Fundraiser::class);
    }

    /**
     * Get all of the donaturs for the Fundraising
     *
     * @return HasMany
     */
    public function donaturs(): HasMany
    {
        return $this->hasMany(Donatur::class)->where('is_paid', 1);
    }

    public function totalReachedAmount()
    {
        return $this->donaturs()->sum('total_amount');
    }

    public function withdrawals()
    {
        return $this->hasMany(FundraisingWithDrawal::class);
    }

    public function fundraising_phases()
    {
        return $this->hasMany(FundraisingPhase::class);
    }

    public function getPercentageAttribute()
    {
        $totalDonations = $this->totalReachedAmount();

        if ($this->target_amount > 0) {
            $percentage = ($totalDonations / $this->target_amount) * 100;
            return $percentage > 100 ? 100 : $percentage ;
        }

        return 0;
    }
}