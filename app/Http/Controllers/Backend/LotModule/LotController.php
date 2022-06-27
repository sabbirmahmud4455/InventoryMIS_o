<?php

namespace App\Http\Controllers\Backend\LotModule;

use App\Http\Controllers\Controller;
use App\Models\LotModule\Lot;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LotController extends Controller
{


    // Store new Lot
    public function store_new_lot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lot_name' => 'required|unique:lots,name',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try{

                $lot = new Lot();
                $lot->name = $request->lot_name;
                $lotSuccessMsg = __('Lot.LotSuccessMsg');

                if($lot->save()){
                    return response()->json(['success' => $lotSuccessMsg], 200);
                }

            } catch(Exception $e){
                return response()->json(['error' => $e->getMessage()], 200);
            }
        }
    }
}
