<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index(){
        $units = Unit::orderBy('full_unit')->where('status', '!=', 'D')->get();
        return view('admin.unit.index', compact('units'));
    }

    public function detail($id){
        $unit = Unit::find($id);

        //return $convSetupList;
        //return $unit;

        $applicableUnitList = Unit::getApplicableUnitList($id);
        //return $applicableUnitList;

        if($unit != null){
            $convSetupList = Unit::activeConvSetups($id);
            return view('admin.unit.detail', compact('unit', 'applicableUnitList', 'convSetupList'));
        }

        return redirect()->route('admin.unit');
    }

    public function saveUnitConversion(Request $request){
        $id = $request->get('conversion_id');
        if(!empty($id))
        {
            $conv_id = DB::table('unit_conv')
                ->where('id', $request->conversion_id)
                ->update([ 'conversion_rate' => $request->get('conversion_rate')]);
            return $conv_id;
        }
        else
        {
            $conv_id = DB::table('unit_conv')->insertGetId(
                [
                    'from_unit_id' => $request->get('from_unit'),
                    'to_unit_id' => $request->get('to_unit'),
                    'conversion_rate' => $request->get('conversion_rate'),
                    'status' => 'A'
                ]
            );
            if(!empty($conv_id)){
                return true;
            }

            return null;
        }
        //return 'BR';
    }

    public function editConversionRate(Request $request){

       // return $request->id;
        $convRate = DB::table('unit_conv')
            ->select('to_unit_id', 'id', 'conversion_rate')
            ->where('id', $request->id)
            ->first();

        $supplierData = array(
            'conversion_id' => $convRate->id,
            'to_unit_id' => $convRate->to_unit_id,
            'conversion_rate' => $convRate->conversion_rate
        );
        return $supplierData;
    }

    public function saveUnit(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Unit::find($request->id);
            if($supplier != null){
                $supplier->full_unit = $request->full_unit;
                $supplier->short_unit = $request->short_unit;
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new Unit();
            $supplier->full_unit = $request->full_unit;
            $supplier->short_unit = $request->short_unit;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateUnit(Request $req)
    {
        $supplier =  Unit::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'full_unit' => $supplier->full_unit,
            'short_unit' => $supplier->short_unit

        );
        return $supplierData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = Unit::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    /* public function blackList(Request $request)
     {
         $supplier = Supplier::find($request->id);
         $supplier->status = 'B';
         if($supplier->save()){
             return true;
         }
         return 'Error';

     }*/

    public function activate(Request $request)
    {
        $supplier = Unit::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';
    }

    public function inActivate(Request $request)
    {
        $supplier = Unit::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';
    }

    public function unitConvSetupList(Request $req)
    {
        //$status = 'A';
        $status = 'A';
        $DropDownData = DB::table("unit_conv")
            ->join('units', 'units.id', '=', 'unit_conv.to_unit_id')
            ->select('units.full_unit AS name', 'units.id')
            ->where("unit_conv.from_unit_id",$req->id)
            ->where("unit_conv.status", $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }

    public function conversionRate(Request $request){
        $priceSetup = DB::table('unit_conv')
            ->select('conversion_rate')
            ->where('from_unit_id', $request->from_unit_id)
            ->where('to_unit_id', $request->to_unit_id)
            ->where('status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'unit_conversion_rate' => $priceSetup->conversion_rate
        );
        return $supplierData;
    }


}
