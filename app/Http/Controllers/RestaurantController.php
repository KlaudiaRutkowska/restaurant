<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restaurant\StoreRequest;
use App\Http\Requests\Restaurant\UpdateRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RestaurantResource::collection(
            Restaurant::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return new RestaurantResource(
            Restaurant::create($request->only('name', 'city', 'street', 'building_number', 'active'))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant->update($request->only('name', 'city', 'street', 'building_number', 'active')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return new JsonResponse(null, 204);
    }
}
