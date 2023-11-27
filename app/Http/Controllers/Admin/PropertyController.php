<?php

namespace App\Http\Controllers\Admin;

use Facades\App\Weather;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PropertyFormRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
       $this->authorizeResource(Property::class, 'property'); 
    }
    public function index()
    {
        dd(Weather::isSunnyTomorrow());
        return view('admin.properties.index',[
            'properties' => Property::orderBy('created_at', 'desc')->withTrashed()->paginate(25) // Organise nos maisons par ordre décroissante
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();

        // préremplir ces données dans notre formulaire
        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Ouagadougou',
            'postal_code' => 34000,
            'sold' => false
        ]);
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id') // Affiche l'id et le nom tous les options
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        // Permet de sauvegardé les options ajoutés a un bien
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'Le bien a été bien créé');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id') // Affiche l'id et le nom tous les options
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->validated());
        // Permet de sauvegardé les options ajoutés a un bien
        $property->options()->sync($request->validated('options')); 
        return to_route('admin.property.index')->with('success', 'Le bien a été bien modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'Le bien a été bien supprimé');
    }
}
