<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'name',
        'slug',
        'icon'
    ];

    /**
     * Get all of the fundraising for the Category
     *
     * @return HasMany
     */
    public function fundraising(): HasMany
    {
        return $this->hasMany(Fundraising::class);
    }
}