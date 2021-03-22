<?php

namespace App\Traits;

use App\Models\Tag;

trait Taggable
{
    protected static function bootTaggable()
    {
        static::updating(function ($model) {
            $model->tags()->sync(static::findTagInContent($model->description));
        });

        static::created(function ($model) {
            $model->tags()->sync(static::findTagInContent($model->description));
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    private static function findTagInContent($content)
    {
        preg_match_all('/@([^@]+)@/m', $content, $tags);
        return Tag::whereIn('name', $tags[1] ?? [])->get();
    }
}
