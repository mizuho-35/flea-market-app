<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Category;


class ItemController extends Controller
{
    public function index(Request $request) {
        $tab = $request->query('tab');
        $keyword = $request->query('keyword');

        if ($tab === 'mylist') {
            if (auth()->check()) {
                $items = auth()->user()
                    ->likedItems()
                    ->when($keyword, function ($query, $keyword) {
                        return $query->where('item_name', 'LIKE', "%{$keyword}%");
                    })
                    ->orderBy('updated_at', 'desc')
                    ->get();
            } else {
                $items = collect();
            }
        } else {
            if (auth()->check()) {
                $items = Item::where('user_id', '!=', auth()->id())
                    ->when($keyword, function ($query, $keyword) {
                        return $query->where('item_name', 'LIKE', "%{$keyword}%");
                    })
                    ->orderBy('updated_at', 'desc')
                    ->get();
            } else {
                $items = Item::when($keyword, function ($query, $keyword) {
                        return $query->where('item_name', 'LIKE', "%{$keyword}%");
                    })
                    ->orderBy('updated_at', 'desc')
                    ->get();
            }
        }
        $layout = auth()->check() ? 'layouts.app' : 'layouts.guest';
        return view('item.index', compact('items', 'layout', 'tab', 'keyword'));
    }


    public function show($item_id) {
        $item = Item::findOrFail($item_id);
        $layout = auth()->check() ? 'layouts.app' : 'layouts.guest';
        $isLiked = false;
        if (auth()->check()) {
            $isLiked = Like::where('user_id', auth()->id())->where('item_id', $item->id)->exists();
        }
        $likeCount = Like::where('item_id', $item->id)->count();
        $commentCount = Comment::where('item_id', $item->id)->count();
        $comments = $item->comments()->with('user')->latest()->get();
        $commentCount = $item->comments()->count();

        return view('item.show', compact(
            'item', 'layout', 'isLiked', 'likeCount', 'commentCount', 'comments'
        ));

    }

    public function search(Request $request) {
        $keyword = $request->input('keyword');
        session(['keyword' => $keyword]);
        $items = Item::when($keyword, function ($query, $keyword) {
            return $query->where('item_name', 'LIKE', "%{$keyword}%");
        })->get();
        $layout = auth()->check() ? 'layouts.app' : 'layouts.guest';
        return view('item.index', [
            'items' => $items,
            'layout' => $layout,
            'tab' => $request->query('tab'),
            'keyword' => $keyword,
        ]);
    }

    public function create() {
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }

    public function store(ExhibitionRequest $request) {
        $data = $request->validated();
        if ($request->hasFile('item_image')) {
            $path = $request->file('item_image')->store('products', 'public');
            $data['item_image'] = $path;
        }
        $data['category_list'] = implode(',', $request->categories);
        $data['user_id'] = auth()->id();
        $data['status'] = 0;

        Item::create($data);
        return redirect('/');
    }


}
