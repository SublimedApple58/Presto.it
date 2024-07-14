<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\Application;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewerController extends Controller
{
    // 
    public function richiesta(){
        return view('reviewer.richiesta');
    }

    public function reviewerArea(){
        return view('reviewer.area');
    }

    public function reviewerUsers(){

        return view('reviewer.users');
    }

    public function reviewerAdvertises(){

        $advertises = Advertise::where('pending', true)->take(1)->get();
        $number = count(Advertise::where('pending', true)->get());
        return view('reviewer.advertises', compact('advertises', 'number'));
    }

    public function accetta(Advertise $advertise){
        $advertise->update([
            'pending' => false
        ]);
        return redirect(route('reviewer.advertises'))->with('message', 'Annuncio accettato');
    }

    public function declina(Advertise $advertise){

        $advertise->update([
            'declined' => true,
            'pending' => false
        ]);
        return redirect(route('reviewer.advertises'))->with('message', 'Annuncio declinato');
    }

    public function delcinedAdvertises(){
        
        $advertises = Advertise::where('declined', true)->get();
        return view('reviewer.declinedAdvertises', compact('advertises'));
    }

    public function delete(Advertise $advertise){
        $images = Image::where('advertise_id', $advertise->id)->get();
        foreach($images as $image){
            $image->delete();
        }
        
        $advertise->delete();
        return redirect(route('reviewer.declinedAdvertises'))->with('message', 'Annuncio cancellato con successo');
    }

    public function reset(Advertise $advertise){

        $advertise->update([
            'declined' => false,
            'pending' => true
        ]);
        return redirect(route('reviewer.declinedAdvertises'))->with('message', 'Annuncio resettato');
    }

}

