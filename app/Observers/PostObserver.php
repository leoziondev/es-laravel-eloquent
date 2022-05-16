<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->user_id = '1'; //auth()->user()->id
    }
}
