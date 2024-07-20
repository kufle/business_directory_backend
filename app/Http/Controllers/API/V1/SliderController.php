<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $sliders = Slider::get();
        return SliderResource::collection($sliders);
    }
}
