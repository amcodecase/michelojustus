<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'owner',
        'description',
        'year',
        'image',
        'url',
        'category',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'order' => 'integer'
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('year', 'desc');
    }
}
