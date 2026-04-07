<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Item;
use App\Models\Address;

class AddressController extends Controller
{
    public function edit($item_id) {
        $user = auth()->user();
        $item = Item::findOrFail($item_id);
        return view('purchase.address', [
            'user' => $user,
            'item' => $item,
            'payment_method' => request('payment_method'),
        ]);
    }

    public function update(AddressRequest $request, $item_id) {
        $user = auth()->user();
        $data = $request->validated();

        $user->profile->update([
            'postcode' => $data['postcode'],
            'address'  => $data['address'],
            'building' => $data['building'] ?? null,
        ]);

        return redirect()->route('purchase.index', [
            'item_id' => $item_id,
            'payment_method' => request('payment_method')
        ]);
    }
}
