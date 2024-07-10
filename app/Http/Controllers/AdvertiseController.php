<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('advertise.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('advertise.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        // prendo l'id della categoria appartenente
        $category = Category::where('name', $request->categories[0])->first();
        // dd($category->id);
        // store dell'Advertise che fa riferimento all'user
        $advertise = Auth::user()->advertises()->create([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $category->id
        ]);

        return redirect(route('homepage'))->with('message', 'annuncio mandato in elaborazione');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertise $advertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertise $advertise)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertise $advertise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertise $advertise)
    {
        $advertise->delete();
        return redirect(route('homepage'))->with('message', 'Annuncio cancellato con successo');
    }
}
