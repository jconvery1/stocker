<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

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
        User::create($request->validated());
        return response()->json("user created!");
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
