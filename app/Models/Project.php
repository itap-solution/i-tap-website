<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_price',
        'project_discount',
        'project_image',
        'project_description',
        'technologies',
        'category',
        'year',
        'github',
        'live',
        'featured',
        'stats'
    ];

    protected $casts = [
        'technologies' => 'array',
        'stats' => 'array',
        'featured' => 'boolean',
        'year' => 'integer',
        'project_price' => 'decimal:2',
        'project_discount' => 'decimal:2'
    ];

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
