<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InterliningPODetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('interlining_p_o_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('interlining_p_o_details')
            ->join('interlining_product_setups', 'interlining_p_o_details.interlining_product_setup_id', '=', 'interlining_product_setups.id')
            ->select('interlining_product_setups.id', 'interlining_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
            ->where('interlining_p_o_details.status', '=', 'A')
            ->orderBy('interlining_product_setups.name')
            ->groupBy('interlining_p_o_details.interlining_product_setup_id', 'interlining_product_setups.id', 'interlining_product_setups.name')
            ->get();

    }
}
