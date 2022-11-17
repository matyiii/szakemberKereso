<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Tradesperson;
use App\Models\Tradesperson_profession;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ListAllTpController extends Controller
{
   public function listAllTp()
   {
      $data = [];
      $data["allTp"] = Tradesperson::select('tradespersons.id', 'firstname', 'lastname')->get();

      //Collect trades
      $tradesIdArr = [];
      foreach ($data["allTp"] as $person) {
         $ids = Tradesperson_profession::select('profession_id')
            ->where('tradesperson_id', $person->id)
            ->get('profession_id')->pluck('profession_id')->toArray();

         $tradesIdArr = Arr::add($tradesIdArr, $person->id, $ids);
      }
      //Add trades to person
      foreach ($data["allTp"] as $person) {
         $person->tradeName = Profession::select('name')->whereIn('id', $tradesIdArr[$person->id])->get()->pluck('name');
      }

      //$data["allTp"] = Tradesperson::with(['professionsTp', 'addressTp'])->get();

      $data['pictures'] = base64_encode(DB::table('pictures')->select('file')->get());
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
      $selectedTrade = $request->selectedTrade;
      $selectedCity = $request->selectedCity;

      $data = [];

      $data['allTp'] = Tradesperson::with(['addressTp' => function ($query) use ($selectedCity) {
         $query->where('id', '=', $selectedCity);
      }])->get();

      /*       $data['allTp'] = Tradesperson::with(['professionsTp' => function($query,Request $request){
         $query->where('professions.id','=', $request->selectedTrade);
      }, 'addressTp'])->get(); */
      dd($data["allTp"]);
      dd($data["allTp"][0]->addressTp);

      return view('tradespersonList')->with('allTp', $data["allTp"]);
   }
}
