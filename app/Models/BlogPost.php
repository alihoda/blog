<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id'];

    protected static function booted()
    {
        // Remove cached key if data changed
        static::updated(function ($blogPost) {
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });
    }

    // Relations
    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps()->as('tagged');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Local Scope
    public function scopeLatest($query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented($query)
    {
        return $query->withCount('comment')->orderBy('comment_count', 'desc');
    }

    public function scopeLatestWithRelation($query)
    {
        return $query->latest()->withCount('comment')->with('user', 'tags');
    }
}
