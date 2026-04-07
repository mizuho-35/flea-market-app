<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request) {
        Like::firstOrCreate([
            'user_id' => auth()->id(),
            'item_id' => $request->item_id,
        ]);

        return back();
    }

    public function destroy(Request $request) {
        Like::where('user_id', auth()->id())
            ->where('item_id', $request->item_id)
            ->delete();

        return back();
    }
}
