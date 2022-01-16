<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GumTapePODetail extends Model
{
    public static function getElasticPODetails($masterId){
        return DB::table('gum_tape_p_o_details')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();
    }

    public static function getUniqueProducts($masterId){

        return DB::table('gum_tape_p_o_details')
            ->join('gum_tape_product_setups', 'gum_tape_p_o_details.gum_tape_product_setup_id', '=', 'gum_tape_product_setups.id')
            ->select('gum_tape_product_setups.id', 'gum_tape_product_setups.name')
            ->where('purchase_order_master_id', $masterId)
            ->orderBy('gum_tape_product_setups.name')
            ->groupBy('gum_tape_p_o_details.gum_tape_product_setup_id', 'gum_tape_product_setups.id', 'gum_tape_product_setups.name')
            ->get();
    }

    public static function getTotalQuantity($masterId){
        $poDetails = DB::table('gum_tape_p_o_details')
            ->select('gum_tape_p_o_details.order_quantity')
            ->where('purchase_order_master_id', $masterId)
            ->where('status' , '!=', 'D')
            ->get();

        $total_order_quantity = 0;
        //$sum_total_price = 0;

        foreach ($poDetails as $detail){
            $total_order_quantity = $total_order_quantity + (float)$detail->order_quantity;
            //$sum_total_price = $sum_total_price + (float)$detail->total_price;
        }



        return $total_order_quantity;
    }

    public static function getSumTotalPriceUSD($masterId){

        $poDetails = DB::table('gum_tape_p_o_details')
            ->select('gum_tape_p_o_details.total_price')
            ->where('purchase_order_master_id', $masterId)
            ->where('gum_tape_p_o_details.currency', '$')
            ->where('status' , '!=', 'D')
            ->get();
        //$total_order_quantity = 0;
        $sum_total_price = 0;
        if($poDetails->count() > 0){
            foreach ($poDetails as $detail){
                //$total_order_quantity = $total_order_quantity + (float)$detail->order_quantity;
                $sum_total_price = $sum_total_price + (float)$detail->total_price;
            }
        }


        return $sum_total_price;

    }

    public static function getSumTotalPriceBDT($masterId){

        $poDetails = DB::table('gum_tape_p_o_details')
            ->select('gum_tape_p_o_details.total_price')
            ->where('purchase_order_master_id', $masterId)
            ->where('gum_tape_p_o_details.currency', '৳')
            ->where('status' , '!=', 'D')
            ->get();

        //$total_order_quantity = 0;
        $sum_total_price = 0;
        if($poDetails->count() > 0){
            foreach ($poDetails as $detail){
                //$total_order_quantity = $total_order_quantity + (float)$detail->order_quantity;
                $sum_total_price = $sum_total_price + (float)$detail->total_price;
            }
        }

        return $sum_total_price;

    }
}
