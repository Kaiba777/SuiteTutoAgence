<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyCollection;

class PropertyController extends Controller
{
    public function index () {
        return PropertyResource::collection(Property::paginate(5));
        // return PropertyResource::collection(Property::limit(5)->with('options')->get());
        //return new PropertyResource(Property::find(1));
    }
}
