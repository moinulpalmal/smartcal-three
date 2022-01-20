<?php

namespace App\Http\Controllers\Merchandising;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\ProductGroup;
use App\Model\PurchaseOrderMaster;
use App\Model\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function report(){
        $product_groups = ProductGroup::getProductGroupsForSelect();
        return view('merchandising.booking.report',
            compact('product_groups'));
    }

    public function reportResult(Request $request){
        $lpd_po_no = $request->get('lpd_po_no');
        if(!empty($lpd_po_no)){
            $purchaseOrders = PurchaseOrderMaster::orderBy('lpd_po_no', 'desc')
                ->where('lpd_po_no', $lpd_po_no)
                ->where('status', '!=', 'D')
                ->get();

            if(!empty( $request->get('product_group'))){
                $purchaseOrders = $purchaseOrders->whereIn('product_group_id', $request->get('product_group'));
            }

            if(!empty($status)){
                $purchaseOrders = $purchaseOrders->whereIn('status', $status);
            }

            return view('merchandising.booking.booking-report', compact('purchaseOrders'));
        }
        else{
            return redirect()->to(route('merchandising.booking.report'));
        }
    }
}
