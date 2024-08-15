<?php
namespace App\Http\Controllers;

use App\Http\Requests\OfferRequet;
use App\Http\Resources\OfferResource;
use App\Jobs\OfferJob;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validated();

        $imagePath = $request->file('image')->store('images', 'public');

        // Create the offer with image path
        $offer = Offer::create(array_merge(
            $validated,
            [
                'user_id' => $user->id, 
                'image' => $imagePath
            ]
        ));

        OfferJob::dispatch($offer);

        return new OfferResource($offer);
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
    public function update(OfferRequet $request, User $user, Offer $offer)
    {
        $user->offers->contains($offer);

        // Handle the file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $request->merge(['image' => $imagePath]); // Update the image path in the request
        }

        // Update the offer with new data
        $offer->update($request->validated());

        return new OfferResource($offer->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Offer $offer)
    {
        $user->offers->contains($offer);
        $offer->delete();
        return response()->json(['message' => 'Offer deleted successfully'], 200);
    }
}
