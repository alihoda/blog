<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commnet extends Model
{
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
