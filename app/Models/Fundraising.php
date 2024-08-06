<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
}