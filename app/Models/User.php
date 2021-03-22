<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogPost()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Local scopes
    public function scopeMostActiveUser($query)
    {
        return $this->withCount('blogPost')->orderBy('blog_post_count', 'desc');
    }

    public function scopeMostActiveLastMonth($query)
    {
        return $query->withCount(['blogPost' => function (Builder $query) {
            return $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }])->having('blog_post_count', '>=', 2)->orderBy('blog_post_count', 'desc');
    }
}
