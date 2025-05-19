<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingAdminController extends Controller
{
    public function index()
    {
        return view('admin.settings.settings');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ];

        // Add password validation rules if password is being changed
        if ($request->filled('current_password')) {
            $rules += [
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
        }

        $validated = $request->validate($rules);

        // Update user information
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password if provided
        if ($request->filled('current_password')) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Profile updated successfully');
    }
} 