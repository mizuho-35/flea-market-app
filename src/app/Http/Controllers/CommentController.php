<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        Comment::create([
            'item_id' => $request->item_id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('item.show', ['item_id' => $request->item_id]);
    }
}
