<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\Item;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $user = auth()->user();
        $profile = $user->profile;
        $sellItems = Item::where('user_id', $user->id)->get();
        $buyItems = Item::whereHas('order', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->get();

        return view('profile.index', compact('user', 'profile', 'sellItems', 'buyItems'));
    }

    public function setup() {
        $user = auth()->user();
        if (!$user->profile) {
            $user->profile()->create([
                'postcode' => '',
                'address' => '',
                'building' => null,
                'profile_image' => null,
            ]);
        }

        return view('profile.edit', [
            'mode' => 'setup',
            'user' => $user->fresh(),
        ]);
    }

    public function store(ProfileRequest $request) {
        $data = $request->validated();
        $user = auth()->user();
        $path = null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
        }

        DB::transaction(function () use ($data, $path, $user) {
            $user->update([
                'username' => $data['username'],
            ]);
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'postcode'      => $data['postcode'],
                    'address'       => $data['address'],
                    'building'      => $data['building'] ?? null,
                    'profile_image' => $path,
                ]
            );
        });
        return redirect()->route('items.index');
    }

    public function edit() {
        return view('profile.edit', [
            'mode' => 'edit',
            'user' => auth()->user(),
        ]);
    }

    public function update(ProfileRequest $request) {
        $user = auth()->user();
        $profile = $user->profile;
        $user->username = $request->username;
        $user->save();
        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                \Storage::disk('public')->delete($profile->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $profile->profile_image = $path;
        }

        $profile->postcode = $request->postcode;
        $profile->address = $request->address;
        $profile->building = $request->building;
        $profile->save();

        return redirect()->route('profile.index');
    }


}
