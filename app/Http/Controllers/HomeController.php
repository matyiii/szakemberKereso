<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Tradesperson;
use Illuminate\Http\Request;

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
        return view('home')->with('highlighted', $highlightedTradespersons)->with('trades',$trades);
    }

    private function listHighlightedTps()
    {
        $data = Tradesperson::all()->where('highlighted', 1);

        return $data;
    }

}
