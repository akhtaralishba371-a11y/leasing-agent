<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $admins = User::orderBy('name')->paginate(15);

        return view('admins.index', compact('admins'));
    }

    public function create(): View
    {
        return view('admins.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admins.index')->with('status', 'Admin created.');
    }

    public function edit(User $admin): View
    {
        return view('admins.edit', ['admin' => $admin]);
    }

    public function update(Request $request, User $admin): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($admin->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $admin->update($data);

        return redirect()->route('admins.index')->with('status', 'Admin updated.');
    }

    public function destroy(Request $request, User $admin): RedirectResponse
    {
        if ($admin->id === $request->user()->id) {
            return redirect()->route('admins.index')->with('status', 'You cannot delete your own account.');
        }

        if (User::count() <= 1) {
            return redirect()->route('admins.index')->with('status', 'Cannot delete the last admin.');
        }

        $admin->delete();

        return redirect()->route('admins.index')->with('status', 'Admin deleted.');
    }
}
