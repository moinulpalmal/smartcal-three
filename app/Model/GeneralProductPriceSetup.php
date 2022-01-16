<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralProductPriceSetup extends Model
{
    public static function getCurrency($product_id, $supplier_id){
        $currency = DB::table('general_product_price_setups')
            ->select('general_product_setup_id', 'supplier_id', 'currency', 'status')
            ->where('status', '!=', 'D')
            ->where('general_product_setup_id', $product_id)
            ->where('supplier_id', $supplier_id)
            ->get();

        if($currency->count() > 0){
            return $currency[0]->currency;
        }

        return 'A';
    }
}
