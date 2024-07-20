<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessResource;
use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $limit = 5;
        if($request->limit && $request->limit > 0 && $request->limit < 20) {
            $limit = $request->limit;
        }
        $business = Business::with('category');

        if ($request->filter && $request->filter == 'popular') {
            $business->orderBy('rating', 'desc');
        }

        return BusinessResource::collection($business->paginate($limit));
    }

    public function show(Business $business)
    {
        //.user di ratings itu , agar kita memanggil relations dengan user
        $business->load(['category', 'ratings.user']);
        return new BusinessResource($business);
    }
}
