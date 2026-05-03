<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller {
    public function edit() {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request) {
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'nullable|string|max:20',
            'bio'           => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $data = $request->only('name','phone','bio');

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profiles','public');
        }

        $user->update($data);
        return back()->with('success', 'Profile updated!');
    }
}