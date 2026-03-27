<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'role'     => 'required|in:admin,customer',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User tạo thành công!');
}

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User cập nhật thành công!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User đã được xóa!');
    }

    // Thùng rác
    // public function trashed()
    // {
    //     $users = User::onlyTrashed()->paginate(10);
    //     return view('admin.users.trashed', compact('users'));
    // }

    // public function restore($id)
    // {
    //     User::withTrashed()->findOrFail($id)->restore();
    //     return redirect()->route('admin.users.trashed')->with('success', 'User đã được khôi phục!');
    // }

    // public function forceDelete($id)
    // {
    //     User::withTrashed()->findOrFail($id)->forceDelete();
    //     return redirect()->route('admin.users.trashed')->with('success', 'User đã bị xóa vĩnh viễn!');
    // }
}
