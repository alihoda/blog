<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Scopes\LatestScope;

class Comment extends Model
{
    use HasFactory;
    
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    // Global Scope
    // protected static function booted()
    // {
    //     static::addGlobalScope(new LatestScope);
    // }

    // Local Scope
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
}
