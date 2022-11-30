<?php

namespace App\Http\Controllers;

use App\Models\Tradesperson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListAllTpController extends Controller
{
   public function listAllTp()
   {
      $data = [];
      $data["allTp"] = Tradesperson::select('tradespersons.id', 'firstname', 'lastname')->get();

      $helper = new HelperController;

      $helper->AddTradesToPersons($data["allTp"]);

      //$data["allTp"] = Tradesperson::with(['professionsTp', 'addressTp'])->get();

      $data['pictures'] = base64_encode(DB::table('pictures')->select('file')->get()); //TODO

      return view('tradespersonList')->with('allTp', $data['allTp'])->with('pictures', $data['pictures']);
   }
   public function getTradespersonData($tradespersonId)
   {
      $selectedTradesPerson = DB::table('tradespersons')
         ->leftJoin('addresses', 'tradespersons.addressId', '=', 'addresses.id')
         ->select('tradespersons.id', 'firstname', 'lastname', 'introduction', 'city', 'zipcode')
         ->where('tradespersons.id', $tradespersonId)
         ->first();
      $tradesId = DB::table('tradesperson_professions')
         ->select('profession_id')
         ->where('tradesperson_professions.tradesperson_id', '=', $selectedTradesPerson->id)
         ->get();
      $tradesIdArr = [];
      foreach ($tradesId as $t) {
         array_push($tradesIdArr, $t->profession_id);
      }
      $tradesNames = DB::table('professions')
         ->select('name')
         ->whereIn('id', $tradesIdArr)
         ->get()->pluck("name")->toArray();
      $html = "";
      if (!empty($selectedTradesPerson)) {
         $html = "<tr>
                 <td width='30%'><b>ID:</b></td>
                 <td width='70%'> " . $selectedTradesPerson->id . "</td>
              </tr>
              <tr>
                 <td width='30%'><b>Name:</b></td>
                 <td width='70%'> " . $selectedTradesPerson->firstname . ' ' . $selectedTradesPerson->lastname . "</td>
              </tr>
              <tr>
                 <td width='30%'><b>ZIP:</b></td>
                 <td width='70%'> " . $selectedTradesPerson->zipcode . "</td>
              </tr>
              <tr>
                 <td width='30%'><b>City:</b></td>
                 <td width='70%'> " . $selectedTradesPerson->city . "</td>
              </tr>
              <tr>
                 <td width='30%'><b>Trades:</b></td>
                 <td width='70%'> " . implode(',', $tradesNames) . "</td>
              </tr>
              <tr>
                 <td width='30%'><b>Introduction:</b></td>
                 <td width='70%'> " . $selectedTradesPerson->introduction . "</td>
              </tr>";
      }
      $response['html'] = $html;
      return response()->json($response);
   }

   public function getSearchedData(Request $request)
   {
      $selectedTrade = $request->tradeSelect;
      $selectedCity = $request->citySelect;
      
      $data = [];

      if($selectedTrade != 0 && $selectedCity != 0){
         $data["allTp"] =  DB::table('tradespersons')
         ->leftJoin('addresses','tradespersons.addressId','=','addresses.id')
         ->leftJoin('tradesperson_professions','tradespersons.id','=','tradesperson_professions.tradesperson_id')
         ->leftJoin('professions','tradesperson_professions.profession_id','=','professions.id')
         ->select('tradespersons.id','firstname','lastname','introduction','city','zipcode','professions.name as tradeName')
         ->where([['professions.id','',$selectedTrade],['addresses.id','',$selectedCity]])
         ->get();
      }
      else if($selectedTrade != 0 && $selectedCity == 0){
         $data["allTp"] =  DB::table('tradespersons')
         ->leftJoin('addresses','tradespersons.addressId','=','addresses.id')
         ->leftJoin('tradesperson_professions','tradespersons.id','=','tradesperson_professions.tradesperson_id')
         ->leftJoin('professions','tradesperson_professions.profession_id','=','professions.id')
         ->select('tradespersons.id','firstname','lastname','introduction','city','zipcode','professions.name as tradeName')
         ->where('professions.id',$selectedTrade)
         ->get();
      }
      else if($selectedTrade == 0 && $selectedCity != 0){
         $data["allTp"] =  DB::table('tradespersons')
         ->leftJoin('addresses','tradespersons.addressId','=','addresses.id')
         ->leftJoin('tradesperson_professions','tradespersons.id','=','tradesperson_professions.tradesperson_id')
         ->leftJoin('professions','tradesperson_professions.profession_id','=','professions.id')
         ->select('tradespersons.id','firstname','lastname','introduction','city','zipcode','professions.name as tradeName')
         ->where('addresses.id',$selectedCity)
         ->get();
      }
      else{
         $data["allTp"] =  DB::table('tradespersons')
         ->leftJoin('addresses','tradespersons.addressId','=','addresses.id')
         ->leftJoin('tradesperson_professions','tradespersons.id','=','tradesperson_professions.tradesperson_id')
         ->leftJoin('professions','tradesperson_professions.profession_id','=','professions.id')
         ->select('tradespersons.id','firstname','lastname','introduction','city','zipcode','professions.name as tradeName')
         ->get();
      }

      $helper = new HelperController;

      $helper->AddTradesToPersons($data["allTp"]);

      /* $data['allTp'] = Tradesperson::with(['addressTp' => function ($query) use ($selectedCity) {
         $query->where('id', '=', $selectedCity);
      }])->get(); */

      /*       $data['allTp'] = Tradesperson::with(['professionsTp' => function($query,Request $request){
         $query->where('professions.id','=', $request->selectedTrade);
      }, 'addressTp'])->get(); */

      return view('tradespersonList')->with('allTp', $data["allTp"]);
   }

   public function deleteTradespersonById($id){
      $tp = Tradesperson::find($id);
      $tp->delete();
   }
}
