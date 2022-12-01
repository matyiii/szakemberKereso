<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Profession;
use App\Models\Tradesperson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;

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
        //$data = Tradesperson::all()->where('highlighted', 1);
        $data = Tradesperson::with(['professionsTp'])->where('highlighted', 1)->get();

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

    public function listSelectedTrade($professionId){
        $data["allTp"] =  DB::table('tradespersons')
        ->leftJoin('addresses','tradespersons.addressId','=','addresses.id')
        ->leftJoin('tradesperson_professions','tradespersons.id','=','tradesperson_professions.tradesperson_id')
        ->leftJoin('professions','tradesperson_professions.profession_id','=','professions.id')
        ->select('tradespersons.id','firstname','lastname','introduction','city','zipcode','professions.name as tradeName')
        ->where('professions.id',$professionId)
        ->get();

        $helper = new HelperController;

        $helper->AddTradesToPersons($data["allTp"]);

        return view('tradespersonList')->with('allTp', $data["allTp"]);
    }
}
