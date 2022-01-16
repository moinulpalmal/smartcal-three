<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(){
        $units = Currency::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.currency.index', compact('units'));
    }

    public function saveCurrency(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Currency::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->symbol = $request->symbol;
                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
        {
            $supplier = new Currency();
            $supplier->name = $request->name;
            $supplier->symbol = $request->symbol;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateCurrency(Request $req)
    {
        $supplier =  Currency::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'symbol' => $supplier->symbol
        );
        return $supplierData;
    }
}
