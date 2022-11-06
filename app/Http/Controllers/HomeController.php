<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Profession;
use App\Models\Tradesperson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $highlightedTradespersons = $this->listHighlightedTps();
        $trades = Profession::all()->take(10);
        $allProfession = $this->listAllProfession();
        $allAddress = $this->listAllAddress();
        return view('home')->with('highlighted', $highlightedTradespersons)->with('trades',$trades)->with('allProfession',$allProfession)
            ->with('allAddress',$allAddress);
    }

    private function listHighlightedTps()
    {
        $data = Tradesperson::all()->where('highlighted', 1);

        return $data;
    }

    private function listAllProfession(){
        $professions = Profession::all()->unique('name');
        return $professions;
    }

    private function listAllAddress(){
        $address = Address::all();
        //dd($address);
        return $address;
    }
}
