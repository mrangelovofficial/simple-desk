<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\CommentCreated;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $user = $comment->ticket->user;
        $user->notify(new CommentCreated($comment));
    }

}
