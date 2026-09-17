<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of user accounts.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $role = $request->query('role');
        $status = $request->query('status');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($role && in_array($role, ['admin', 'user']), function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('status', $status === '1' || $status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalCustomers = User::where('role', 'user')->count();
        $activeUsers = User::where('status', true)->count();
        $inactiveUsers = User::where('status', false)->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalAdmins',
            'totalCustomers',
            'activeUsers',
            'inactiveUsers',
            'search',
            'role',
            'status'
        ));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['required', 'string', 'min:6'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['nullable'],
        ]);

        $validated['status'] = $request->has('status');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'user_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/users');

            if (! File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $validated['photo'] = 'uploads/users/'.$filename;
        }

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User account created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'string', 'min:6'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'status' => ['nullable'],
        ]);

        // Prevent self-demotion or self-deactivation
        if (auth()->id() === $user->id) {
            $validated['role'] = 'admin';
            $validated['status'] = true;
        } else {
            $validated['status'] = $request->has('status');
        }

        // Only update password if provided
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'user_'.time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/users');

            if (! File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Remove old photo if exists
            if ($user->photo && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }

            $file->move($destinationPath, $filename);
            $validated['photo'] = 'uploads/users/'.$filename;
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User account updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account!');
        }

        if ($user->photo && File::exists(public_path($user->photo))) {
            File::delete(public_path($user->photo));
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User account deleted successfully!');
    }

    /**
     * Toggle active/inactive status of the specified user.
     */
    public function toggleStatus(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot deactivate your own account!');
        }

        $user->update([
            'status' => ! $user->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User status updated successfully!');
    }
}
