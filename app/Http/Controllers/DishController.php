<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
use App\Http\Resources\DishResource;
use App\Models\Dish;
use Illuminate\Http\JsonResponse;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DishResource::collection(
            Dish::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return new DishResource(
            Dish::create($request->only('name', 'price', 'active'))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return new DishResource($dish);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Dish $dish)
    {
        return new DishResource(
            $dish->update($request->only('name', 'price', 'active'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return new JsonResponse(null, 204);
    }
}
