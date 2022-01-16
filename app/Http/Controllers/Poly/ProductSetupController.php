<?php

namespace App\Http\Controllers\Poly;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use App\Model\PolyProductPriceSetup;
use App\Model\PolyProductSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSetupController extends Controller
{
    //$product_group_id = 6;
    public function index(){


        $products = PolyProductSetup::orderBy('name')
            ->where('status', '!=', 'D')
            ->get();

        return view('poly.product.index', compact('products'));
    }

    public function detail($id){
        $product = PolyProductSetup::find($id);

        if($product != null){

            $productPriceSetups = PolyProductPriceSetup::where('status', '!=', 'D')
                ->where('poly_product_setup_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            $supplierByGroup = Supplier::getActiveSupplierByProductGroup(6);

            return view('poly.product.detail',
                compact('product', 'productPriceSetups', 'supplierByGroup'));
        }

        return redirect()->route('poly.product');
    }

    public function saveProduct(Request $request){
        $id = $request->get('id');
        //return 'Saved';
        if(!empty($id))
        {
            $supplier = PolyProductSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->poly_type = $request->poly_type;
                //$supplier->gross_form_factor = $request->gross_form_factor;
                //$supplier->per_con_length = $request->per_con_length;
                $supplier->last_updated_by = Auth::id();
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new PolyProductSetup();
            $supplier->name = $request->name;
            $supplier->poly_type = $request->poly_type;
            $supplier->inserted_by = Auth::id();

            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateProduct(Request $req)
    {
        $factory = PolyProductSetup::find($req->id);
        $factoryData = array(
            'name' => $factory->name,
            'poly_type' => $factory->poly_type,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function deleteProduct(Request $request){

    }
    public function savePriceSetup(Request $request){
        //$id = $request->get('id');

        $productPriceSetup = PolyProductPriceSetup::where('status', '!=', 'D')
            ->where('poly_product_setup_id', $request->poly_product_setup_id)
            ->where('supplier_id', $request->supplier)
            ->where('status', '!=', 'D')
            ->first();
        if($productPriceSetup != null){
            $conv_id = DB::table('poly_product_price_setups')
                ->where('poly_product_setup_id', $request->poly_product_setup_id)
                ->where('supplier_id', $request->supplier)
                ->update([
                    'poly_product_setup_id' => $request->get('poly_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
                    'currency' => $request->get('currency'),
                    'price_unit' => $request->get('price_unit'),
                    'unit_price' => $request->get('unit_price'),
                    'first_usd_conversion_value' => $request->get('first_usd_conversion_value'),
                    'second_usd_conversion_value' => $request->get('second_usd_conversion_value'),
                    'adhesive_price' => $request->get('adhesive_price'),
                    'printing_price' => $request->get('printing_price'),
                    'status' => 'A'
                ]);

            return $conv_id ;
        }
        else {

            $conv_id = DB::table('poly_product_price_setups')->insertGetId(
                [
                    'poly_product_setup_id' => $request->get('poly_product_setup_id'),
                    'supplier_id' => $request->get('supplier'),
                    'currency' => $request->get('currency'),
                    'price_unit' => $request->get('price_unit'),
                    'unit_price' => $request->get('unit_price'),
                    'first_usd_conversion_value' => $request->get('first_usd_conversion_value'),
                    'second_usd_conversion_value' => $request->get('second_usd_conversion_value'),
                    'adhesive_price' => $request->get('adhesive_price'),
                    'printing_price' => $request->get('printing_price'),
                    'status' => 'A'
                ]
            );
            if (!empty($conv_id)) {
                return true;
            }

            return null;
        }
    }



    public function getPriceSetup(Request $request)    {

        $priceSetup = DB::table('poly_product_price_setups')
            ->join('poly_product_setups', 'poly_product_setups.id', '=', 'poly_product_price_setups.poly_product_setup_id')
            ->select('poly_product_price_setups.unit_price',
                'poly_product_price_setups.first_usd_conversion_value',
                'poly_product_price_setups.second_usd_conversion_value',
                'poly_product_price_setups.adhesive_price',
                'poly_product_price_setups.currency',
                'poly_product_price_setups.price_unit',
                'poly_product_setups.poly_type',
                'poly_product_price_setups.printing_price')
            ->where('poly_product_setups.id', $request->id)
            ->where('poly_product_price_setups.supplier_id', $request->supplier)
            ->where('poly_product_price_setups.status', 'A')
            ->first();
        //$supplier =  TrimsType::find($req->id);
        if($priceSetup == null)
            return null;
        $supplierData = array(
            'poly_type' => $priceSetup->poly_type,
            'currency' => $priceSetup->currency,
            'price_unit' => $priceSetup->price_unit,
            'unit_price' => $priceSetup->unit_price,
            'first_usd_conversion_value' => $priceSetup->first_usd_conversion_value,
            'second_usd_conversion_value' => $priceSetup->second_usd_conversion_value,
            'adhesive_price' => $priceSetup->adhesive_price,
            'printing_price' => $priceSetup->printing_price
        );
        return $supplierData;

        //return 0;
    }
}
