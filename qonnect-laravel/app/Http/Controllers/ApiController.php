<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ssi_historical;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function insert_ssi_historical(Request $request){
        $machine_data = new ssi_historical;
        $machine_data->name = $request->name;
        $machine_data->t_message = $request->t_message;
        $machine_data->person = $request->person;
        
        $machine_data->save();

        return response()->json([
            "message" => "machine data record created"
        ], 201);   
    }
}
