<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        if(auth()->user()->isAdmin()) {
            return UserResource::collection(
                User::all()
            );
        }
        return abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()) {
            User::create($request->validated());
        }
        return abort(401);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if(auth()->user()->isAdmin()) {
            return new UserResource($user);
        }
        return abort(401);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(auth()->user()->isAdmin()) {
            $user->update($request->only(['name', 'email', 'password']));
        }
        return abort(401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(auth()->user()->isAdmin()) {
            return $user->delete();
        }
        return abort(401);
    }
}
