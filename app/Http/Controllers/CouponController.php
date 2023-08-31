<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coupon\StoreRequest;
use App\Http\Requests\Coupon\UpdateRequest;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CouponResource::collection(
            Coupon::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return new CouponResource(
            Coupon::create($request->only('code', 'discount_percentage', 'active'))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return new CouponResource($coupon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Coupon $coupon)
    {
        return new CouponResource(
            $coupon->update($request->only('code', 'discount_percentage', 'active'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return new JsonResponse(null, 204);
    }
}
