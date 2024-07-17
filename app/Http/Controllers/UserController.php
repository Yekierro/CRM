<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginName' => 'required',
            'loginPassword' => 'required',
        ]);

        if (Auth::attempt(['name' => $incomingFields['loginName'], 'password' => $incomingFields['loginPassword']])) {
            $request->session()->regenerate();

            $user = auth()->user();

            // Проверяем и устанавливаем роль, если её нет
            if (!$user->role) {
                if (strpos($user->email, '@admin.com') !== false) {
                    $user->role = 'admin';
                } elseif (strpos($user->email, '@customer.com') !== false) {
                    $user->role = 'customer';
                } else {
                    $user->role = 'user';
                }
                $user->save();
            }

            // Редирект в зависимости от роли пользователя
            return $this->redirectBasedOnRole($user->role);
        }

        return back()->withErrors([
            'loginName' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        // Установка роли на основе почтового домена
        if (strpos($user->email, '@admin.com') !== false) {
            $user->role = 'admin';
        } elseif (strpos($user->email, '@customer.com') !== false) {
            $user->role = 'customer';
        } else {
            $user->role = 'user';
        }
        $user->save();

        // Редирект в зависимости от роли пользователя
        return $this->redirectBasedOnRole($user->role);
    }

    protected function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect('/admin');
            case 'customer':
                return redirect('/customer');
            default:
                return redirect('/');
        }
    }

    public function showUsers()
    {
        $users = User::all();
        $posts = Post::all();
        return view('admin-page', ['users' => $users, 'posts' => $posts]);
    }

    public function deleteUser($id)
    {
        // Удаление связанных записей в таблице posts
        Post::where('user_id', $id)->delete();

        // Затем удаляем пользователя
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function editUserForm($id)
    {
        $user = User::findOrFail($id);
        return view('edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'password']));
        return redirect()->route('admin.page')->with('success', 'User updated successfully');
    }

    public function showCustomerPage()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('customer', ['posts' => $posts]);
    }


}

