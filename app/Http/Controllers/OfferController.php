<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequet;
use App\Http\Resources\OfferResource;
use App\Jobs\OfferJob;
use App\Mail\OfferMail;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OfferResource::collection(
            Offer::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequet $request, User $user)
    {
        $offer = Offer::create(array_merge(
            $request->validated(),
            ["user_id" => $user->id]
        ));
        OfferJob::dispatch($request->validated());
        
        return $offer;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Offer $offer)
    {
        $user->offers->contains($offer);
        return OfferResource::make($offer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequet $request, User $user , Offer $offer)
    {
        $user->offers->contains($offer);
        $offer->update($request->validated());
        return OfferResource::make(
            $offer->refresh()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user , Offer $offer)
    {
        $user->offers->contains($offer);
        return $offer->delete();
    }
}
