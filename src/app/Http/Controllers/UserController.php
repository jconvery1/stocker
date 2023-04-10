<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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
            'email' => ['required', 'unique:users', 'email']
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
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

    public function signIn(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        $user = User::where('username', $request->username)->get();
        if (count($user) > 0) {
            $password = Hash::make($user[0]->password);
            if (Hash::check($request->password, $password)) {
                $request->session()->put('loginId', $user[0]->id);
                return redirect('/stock');
            } else {
                return back()->with('fail', 'Username and password do not match');
            }
        } else {
            return back()->with('fail', 'Username not found');
        }
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
