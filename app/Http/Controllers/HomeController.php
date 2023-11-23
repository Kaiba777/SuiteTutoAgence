<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $properties = Property::available()->recent()->limit(4)->get();
        // $user = User::first();
        // $user->password = '0000';
        // $user->syncChanges();
        // dd($user->password, $user);
        return view('home',[
            'properties' => $properties
        ]);
    }
}
