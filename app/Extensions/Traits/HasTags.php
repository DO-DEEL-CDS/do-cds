<?php

namespace App\Extensions\Traits;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

trait HasTags
{

    public static function bootHasTags()
    {
        static::saved(function (Model $post) {
            if ($selected_tags = request('tags')) {
                $post->processTagsFromRequest($selected_tags);
            }
        });
    }

    private function processTagsFromRequest($selected_tags)
    {
        if (count($selected_tags)) {
            $tags = collect($selected_tags)->map(function ($tag) {
                $tagModel = Tag::query()->firstOrNew([
                    'name' => $tag,
                ]);
                $tagModel->slug = Str::slug($tag);
                return $tagModel;
            })->all();

            $this->tags()->saveMany($tags);
        }
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

}
