<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id',
        'description'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSlugOptions() : SlugOptions{
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

}
