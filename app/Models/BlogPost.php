<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\LatestScope;

class BlogPost extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'description', 'user_id'];

    public function comment()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Global Scope
    // protected static function booted()
    // {
    //     static::addGlobalScope(new LatestScope);
    // }

    // Local Scope
    public function scopeLatest($query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented($query)
    {
        return $this->withCount('comment')->orderBy('comment_count', 'desc');
    }
}
