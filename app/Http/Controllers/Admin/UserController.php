<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pagesize = $request->input('pagesize', 10);

        if ($search) {
            $users = User::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->paginate($pagesize);
        } else {
            $users = User::paginate($pagesize);
        }

        return view('view-admin.user.index', compact('users', 'search', 'pagesize'));
    }

    public function show(User $user)
    {
        return view('view-admin.user.show', compact('user'));
    }
    

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'is_admin' => 'required|boolean',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function toggleAdmin(User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();

        return response()->json(['success' => true, 'is_admin' => $user->is_admin]);
    }
}
