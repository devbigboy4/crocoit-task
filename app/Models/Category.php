<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'parent_id',
    ];

    // protected static function boot()
    // {
    //     parent::boot();
    //     // static::observe(CategoryObserver::class);
    // }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['category'] ?? false, function ($builder, $value) {
            if (is_array($value)) {
                $builder->whereIn('parent_id', $value);
            } else {
                $builder->where('parent_id', '=', $value);
            }
        });

        $builder->orderBy('name', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault(['name' => 'Primary category']);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

}
