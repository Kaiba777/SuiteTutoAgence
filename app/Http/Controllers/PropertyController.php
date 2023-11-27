<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Mail\PropertyContactMail;
use App\Events\ContactRequestEvent;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;

class PropertyController extends Controller
{
    public function index (SearchPropertiesRequest $request)
    {
        $query = Property::query()->orderBy('created_at', 'desc');
        // Permet d'afficher les biens en dessous du prix entré
        if ($price = $request->validated('price')) {
            $query = $query->where('price', '<=', $price);
        } 
        // Permet d'afficher les biens au dessus de la surface entré
        if ($surface = $request->validated('surface')) {
            $query = $query->where('surface', '>=', $surface);
        } 
        // Permet d'afficher les biens en dessous de la pièce entré
        if ($rooms = $request->validated('rooms')) {
            $query = $query->where('rooms', '>=', $rooms);
        } 
        // Permet d'afficher un mot entré
        if ($title = $request->validated('title')) {
            $query = $query->where('title', 'like', "%{$title}%");
        } 
        $properties = Property::paginate(16);
        return view('property.index', [
            'properties' => $query->paginate(16),
            'input' => $request->validated()
        ]);
    }

    public function show (string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();
        if($slug != $expectedSlug) {
            return to_route('property.show', ['slug' => $expectedSlug, 'property' => $property]);
        }
        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property,PropertyContactRequest $request)
    { 
        // Permet de mettre un événement  
        event(new ContactRequestEvent($property, $request->validated()));
        // Redirige vers la page précédente
        return back()->with('success', 'Votre demande de contact a bien été envoyé');
    }
}
