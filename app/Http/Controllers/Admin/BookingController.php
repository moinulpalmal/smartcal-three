<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PurchaseOrderMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function resetLPDPO(Request $request){
        //$purchase_order_master = PurchaseOrderMaster::find($request->id);
        if(PurchaseOrderMaster::resetLPDPONo($request->id)){
            return true;
        }

        return null;
    }
}
