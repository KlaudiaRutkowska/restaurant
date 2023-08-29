<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingCart\StoreRequest;
use App\Http\Requests\ShoppingCart\UpdateRequest;
use App\Http\Resources\ShoppingCartResource;
use App\Models\ShoppingCart;
use Illuminate\Http\JsonResponse;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ShoppingCartResource::collection(
            ShoppingCart::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return new ShoppingCartResource(
            ShoppingCart::create($request->only('quantity'))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingCart $shoppingCart)
    {
        return new ShoppingCartResource($shoppingCart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ShoppingCart $shoppingCart)
    {
        return new ShoppingCartResource(
            $shoppingCart->update($request->only('quantity'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingCart $shoppingCart)
    {
        $shoppingCart->delete();

        return new JsonResponse(null, 204);
    }
}
