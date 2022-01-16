<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    public static function activeConvSetups($from_unit_id){

       return DB::table('unit_conv')
            ->join('units', 'units.id', '=', 'unit_conv.from_unit_id')
            ->select('unit_conv.status', 'unit_conv.conversion_rate', 'unit_conv.to_unit_id',  'unit_conv.id')
            ->where('unit_conv.status', '!=', 'D')
            ->where('unit_conv.from_unit_id', $from_unit_id)
            ->get();
    }

    public static function getApplicableUnitList($from_unit_id){
        $currentUnits = DB::table('unit_conv')
                ->join('units', 'units.id', '=', 'unit_conv.from_unit_id')
                ->select( 'unit_conv.to_unit_id')
                ->where('unit_conv.status', '!=', 'D')
                ->where('unit_conv.from_unit_id', $from_unit_id)
                ->get();

        $activeUnits = self::getAllUnits();

        foreach ($currentUnits as $currentUnit){
            $activeUnits->where('id', '!=', $currentUnit->to_unit_id);
        }

        return $activeUnits;
    }

    public static function getAllUnits(){
        return DB::table('units')
            ->select('full_unit', 'short_unit', 'id')
            ->where('status', '!=', 'D')
            ->orderBy('full_unit')
            ->get();
    }

    public static function getAllActiveUnitsForSelectList(){
        return DB::table('units')
            ->select('full_unit', 'short_unit', 'id')
            ->where('status',  'A')
            ->orderBy('full_unit')
            ->get();
    }

    public static function unitDetails($id){
        return Unit::find($id);
    }


    public static function insertIntoConversion($request){
        $values = array('from_unit_id' => $request->from_unit,
            'to_unit_id' => $request->to_unit,
            'conversion_rate' => $request->conversion_rate,
            'status' => 'A');

        $result = DB::table('unit_conv')->insert($values);

        return $result;
    }


    public static function updateIntoConversion($request){

        $affected = DB::table('unit_conv')
            ->where('id', $request->id)
            ->update(['conversion_rate' => $request->conversion_rate]);

        return $affected;
    }

    public static function deleteIntoConversion($request){

        $affected = DB::table('unit_conv')
            ->where('id', $request->id)
            ->update(['status' => 'D']);

        return $affected;
    }

    public static function activateIntoConversion($request){

        $affected = DB::table('unit_conv')
            ->where('id', $request->id)
            ->update(['status' => 'A']);

        return $affected;
    }

    public static function inActivateIntoConversion($request){

        $affected = DB::table('unit_conv')
            ->where('id', $request->id)
            ->update(['status' => 'I']);

        return $affected;
    }
}
