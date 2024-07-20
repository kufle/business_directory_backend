<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Models\Business;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Business $business)
    {
        $request->validate([
            'rating' => ['required'],
        ]);
        
        $business->ratings()->create([
            'user_id' => auth()->user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        $ratings = $business->ratings()->with('user')->get();

        return RatingResource::collection($ratings)->response()->setStatusCode(201);
    }
}
