<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThreadProductSetup extends Model
{
    public static function getActiveProductListForSelect($supplier_id){
        return DB::table('thread_product_price_setups')
            ->join('thread_product_setups', 'thread_product_setups.id', '=', 'thread_product_price_setups.thread_product_setup_id')
            ->select('thread_product_setups.name', 'thread_product_setups.id')
            ->where('thread_product_price_setups.supplier_id', $supplier_id)
            ->where('thread_product_setups.status', 'A')
            ->where('thread_product_price_setups.status', 'A')
            ->groupBy('thread_product_setups.name', 'thread_product_setups.id')
            ->orderBy('thread_product_setups.name')
            ->get();
    }
}
