<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
public function index(Request $request)
{
    $search = trim($request->input('search', ''));

    $users = User::query()
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(15)
        ->withQueryString();

    return view('admin.users.index', compact('users', 'search'));
}


    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => [
    'required',
    Rule::in(['customer', 'delivery', 'restaurant']),
],
        ]);

        // Prevent an admin from accidentally removing their own admin role.
        if (
            auth()->id() === $user->id &&
            $validated['role'] !== 'admin'
        ) {
            return back()->with(
                'error',
                'You cannot remove your own admin role.'
            );
        }

        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }
}
