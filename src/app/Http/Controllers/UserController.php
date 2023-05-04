<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(StoreUserRequest $request)
    {
        $request->validate([
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
            'role' => ['required']
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->fill([
            'password' => Hash::make($user->password)
        ]);
        $response = $user->save();
        if ($response) {
            return back()->with('success', 'account successfully created!');
        } else {
            return back()->with('fail', 'something went wrong!');
        }
    }

    public function signInScreen() {
        return view('signIn');
    }

    public function signIn(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', '=', $username)->first();
        if ($user && $request->password == $password) {
            Auth::login($user);
            if (Auth::check()) {
                return redirect('/stock');
            }
        }
        return back()->with('fail', 'No account found for these credentials!');
    }

    /**
     * Log the user out of the application.
     */
    public function signOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('signIn');
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json("user updated");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json("user deleted");
    }
}
