<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'asc')->get();

        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        $category->load('businesses.category');
        return new CategoryResource($category);
    }
}
