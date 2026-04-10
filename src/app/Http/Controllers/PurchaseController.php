<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Order;

class PurchaseController extends Controller
{
    public function show($item_id) {
        $user = auth()->user();
        $item = Item::findOrFail($item_id);

        return view('purchase.index', compact('user', 'item'));
    }

    public function store(PurchaseRequest $request, $item_id) {
        $user = auth()->user();
        $order = Order::create([
            'user_id' => $user->id,
            'item_id' => $item_id,
            'payment_method' => $request->payment_method,
        ]);
        $item = Item::findOrFail($item_id);
        $item->update(['status' => 1]);
        $profile = $user->profile;
        $order->address()->create([
            'postcode' => $profile->postcode,
            'address'  => $profile->address,
            'building' => $profile->building,
        ]);

        return redirect('/');
    }
}
