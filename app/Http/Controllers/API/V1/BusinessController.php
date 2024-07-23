<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusinessResource;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = [
            'category_id' => $request->category,
            'name' => $request->name,
            'contact' => $request->contact,
            'address' => $request->address,
            'about' => $request->about,
            'website' => $request->website,
        ];

        if($request->hasFile('image')){
            $uploadPath = 'assets/images/business';
            $imageFile = $request->file('image');
            $imageName = time()."_".$imageFile->getClientOriginalName();
            //store to public path
            $imageFile->move($uploadPath,$imageName);
            $data['image'] = $imageName;
        }

        $business = $request->user()->businesses()->create($data);
        $businessResource = $business->load(['category', 'ratings.user']);
        return new BusinessResource($businessResource);
    }

    public function show(Business $business)
    {
        //.user di ratings itu , agar kita memanggil relations dengan user
        $business->load(['category', 'ratings.user']);
        return new BusinessResource($business);
    }

    public function destroy(Business $business)
    {
        if($business->user_id !== auth()->id()) {
            return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }

        $business->delete();
    }

    public function mybusiness()
    {
        $user = Auth::user();
        $business = $user->businesses()->with('category')->get();

        return BusinessResource::collection($business);
    }
}
