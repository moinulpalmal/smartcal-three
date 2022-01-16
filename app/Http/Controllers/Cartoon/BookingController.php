<?php

namespace App\Http\Controllers\Cartoon;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\CartoonProductSetup;
use App\Model\CartoonPurchaseOrderDetail;
use App\Model\DeliveryLocation;
use App\Model\DeliveryLocationDetail;
use App\Model\PurchaseOrderMaster;
use App\Model\Supplier;
use App\Model\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Float_;

class BookingController extends Controller
{
    //group id: 1
    public function recent(){
        $purchaseOrders = PurchaseOrderMaster::orderBy('lpd_po_no', 'desc')
            ->where('product_group_id', 1)
            ->where('status', '!=', 'D')
            ->get()
            ->take(500);

        //return $purchaseOrders;
        return view('cartoon.booking.recent', compact('purchaseOrders'));

    }

    public function search(){
        $suppliers = Supplier::getActiveSupplierByProductGroup(1);
        //$deliveryLocations = DeliveryLocation::getDeliveryLocationForSelectField();
        $buyers = Buyer::getBuyersForSelectField();
        $currentDate = Carbon::now();

        //return $currentDate;

        return view('cartoon.booking.search',
            compact('suppliers', 'buyers', 'currentDate'));
    }

    public function searchBooking(Request $request){
        $lpd_po_no = $request->get('lpd_po_no');

        if(!empty($lpd_po_no)){

            $purchaseOrders = PurchaseOrderMaster::orderBy('lpd_po_no', 'desc')
                ->where('product_group_id', 1)
                ->where('lpd_po_no', $lpd_po_no)
                ->where('status', '!=', 'D')
                ->get();

            return view('cartoon.booking.search-result', compact('purchaseOrders'));
        }
        else{

            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $supplier_id = $request->get('supplier');


            $purchaseOrders = PurchaseOrderMaster::orderBy('lpd_po_no', 'desc')
                ->where('product_group_id', 1)
                ->whereBetween('lpd_po_date', array($from_date, $to_date))
                ->where('status', '!=', 'D')
                ->get();

            if(!empty($supplier_id)){
                $purchaseOrders = $purchaseOrders->where('supplier_id', $supplier_id);
            }

            return view('cartoon.booking.search-result', compact('purchaseOrders'));
        }

        //return $purchaseOrders;

    }

    public function newBooking(){

        $suppliers = Supplier::getActiveSupplierByProductGroup(1);
        $deliveryLocations = DeliveryLocation::getDeliveryLocationForSelectField();
        $buyers = Buyer::getBuyersForSelectField();

        return view('cartoon.booking.new',
            compact('suppliers', 'deliveryLocations', 'buyers'));
    }

    public function saveBooking(Request $request){

        //return $request->all();

        $this->validate($request, [
            'booking_date' => 'required|date',
            'delivery_date' => 'required|date',
            'supplier' => 'required',
            'delivery_location' => 'required',
            'buyer' => 'required',
            'style' => 'required|string|max:200',
            'consumption_per_dz' => 'required|string|max:200',
            'garments_quantity' => 'required|numeric|min:1'
        ]);

        //return $request->all();

        //return $this->getLPDPoNo();

        $purchase_order_master = new PurchaseOrderMaster();


        $purchase_order_master->year = Carbon::now()->year;
        $purchase_order_master->month = Carbon::now()->month;

        $purchase_order_master->product_group_id = 1;
        $purchase_order_master->lpd_po_date = $request->booking_date;
        $purchase_order_master->delivery_date = $request->delivery_date;
        $purchase_order_master->supplier_id = $request->supplier;
        $purchase_order_master->buyer_id = $request->buyer;
        $purchase_order_master->delivery_location_id = $request->delivery_location;
        $purchase_order_master->delivery_location_detail_id = $request->delivery_location_detail_id;
        $purchase_order_master->style = $request->style;
        $purchase_order_master->consumption_per_dz = $request->consumption_per_dz;
        $purchase_order_master->garments_quantity = $request->garments_quantity;
        $purchase_order_master->buyer_po_no = $request->buyer_po_no;
//        $purchase_order_master->description = $request->description;
        $purchase_order_master->remarks = $request->remarks;
        $purchase_order_master->inserted_by = Auth::id();
        $newLPDPo = PurchaseOrderMaster::getLPDPoNo();
        $purchase_order_master->lpd_po_no = $newLPDPo;
        if($purchase_order_master->save()){
            return redirect()->route('cartoon.booking.detail', ['id' => $purchase_order_master->id]);
        }
        return back();
    }


    public function updateBooking(Request $request){

        //return $request->all();

        $this->validate($request, [
            'booking_date' => 'required|date',
            'delivery_date' => 'required|date',
//            'supplier' => 'required',
            'delivery_location' => 'required',
            'buyer' => 'required',
            'style' => 'required|string|max:200',
            'consumption_per_dz' => 'required|string|max:200',
            'garments_quantity' => 'required|numeric|min:1'
        ]);


        $purchase_order_master = PurchaseOrderMaster::find($request->id);

        $purchase_order_master->product_group_id = 1;
        $purchase_order_master->lpd_po_date = $request->booking_date;
        $purchase_order_master->delivery_date = $request->delivery_date;
//        $purchase_order_master->supplier_id = $request->supplier;
        $purchase_order_master->buyer_id = $request->buyer;
        $purchase_order_master->delivery_location_id = $request->delivery_location;
        $purchase_order_master->delivery_location_detail_id = $request->delivery_location_detail_id;
        $purchase_order_master->style = $request->style;
        $purchase_order_master->consumption_per_dz = $request->consumption_per_dz;
        $purchase_order_master->garments_quantity = $request->garments_quantity;
//        $purchase_order_master->description = $request->description;
        $purchase_order_master->remarks = $request->remarks;
        $purchase_order_master->buyer_po_no = $request->buyer_po_no;
        $purchase_order_master->last_updated_by = Auth::id();

        if($purchase_order_master->save()){
            return redirect()->route('cartoon.booking.detail', ['id' => $purchase_order_master->id]);
        }

        return back();
    }
    public function detail($id){
        $purchase_order_master = PurchaseOrderMaster::find($id);

        if($purchase_order_master != null){
            if($purchase_order_master->product_group_id == 1){
                if($purchase_order_master->status != 'D'){
                    $duplicate = PurchaseOrderMaster::checkDuplicateLpdPO($id);
                    //return $duplicate;
                    $products = CartoonProductSetup::getActiveProductListForSelect($purchase_order_master->supplier_id);
                    $details = CartoonPurchaseOrderDetail::getCartoonPODetails($id);
                    $uniqueProducts = CartoonPurchaseOrderDetail::getUniqueProducts($id);
                    $units = Unit::getAllActiveUnitsForSelectList();
                    $purchaseOrder = $purchase_order_master;

                    return view('cartoon.booking.detail',
                        compact('purchaseOrder',
                             'products', 'details', 'uniqueProducts', 'units', 'duplicate'));

                }
                return redirect()->route('cartoon.booking.recent');
            }
            return redirect()->route('cartoon.booking.recent');
        }

        return redirect()->route('cartoon.booking.recent');
    }

    public function edit($id){
        $purchase_order_master = PurchaseOrderMaster::find($id);

        if($purchase_order_master != null){
            if($purchase_order_master->product_group_id == 1){
                if($purchase_order_master->status != 'D'){

                    //return $purchase_order_master;
                    $suppliers = Supplier::getActiveSupplierByProductGroup(1);
                    $deliveryLocations = DeliveryLocation::getDeliveryLocationForSelectField();
                    $buyers = Buyer::getBuyersForSelectField();

                    $purchaseOrder = $purchase_order_master;

                    return view('cartoon.booking.edit',
                        compact('purchaseOrder', 'suppliers',
                            'deliveryLocations', 'buyers'));

                }
                return redirect()->route('cartoon.booking.recent');
            }
            return redirect()->route('cartoon.booking.recent');
        }

        return redirect()->route('cartoon.booking.recent');
    }

    public function pdf($id){
        $purchase_order_master = PurchaseOrderMaster::find($id);

        if($purchase_order_master != null){
            if($purchase_order_master->product_group_id == 1){
                if($purchase_order_master->status != 'D'){
                    $details = CartoonPurchaseOrderDetail::getCartoonPODetails($id);
                    $uniqueProducts = CartoonPurchaseOrderDetail::getUniqueProducts($id);
                    $total_price = CartoonPurchaseOrderDetail::getSumTotalPrice($id);
                    $total_order_quantity = CartoonPurchaseOrderDetail::getTotalQuantity($id);

                    $master = $purchase_order_master;

                    return view('cartoon.booking.print',
                        compact('master',
                              'details', 'uniqueProducts', 'total_price', 'total_order_quantity'));

                }
                return redirect()->route('cartoon.booking.recent');
            }
            return redirect()->route('cartoon.booking.recent');
        }

        return redirect()->route('cartoon.booking.recent');
    }

    public function delete(Request $request){
        $purchase_order_master = PurchaseOrderMaster::find($request->id);
        if($purchase_order_master != null){
            $purchase_order_master->status = 'D';
            $purchase_order_master->last_updated_by = Auth::id();

            if($purchase_order_master->save()){
                return true;
            }
            return null;
        }

        return null;
    }

    public function deleteDetail(Request $request){
        $id = $request->get('item_id');

        $purchaseOrderDetail = CartoonPurchaseOrderDetail::where('purchase_order_master_id', $request->purchase_order_master_id)
            ->where('item_count', $id)
            ->first();

        if(!empty($purchaseOrderDetail)){
            $result = DB::table('cartoon_purchase_order_details')
                ->where('item_count', $id)
                ->where('purchase_order_master_id', $request->purchase_order_master_id)
                ->update(['status' => 'D']);

            if($result){
                return 'Updated';
            }
            return "Error";
        }

        return "Error";
    }

    public function makeUrgent(Request $request){
        $purchase_order_master = PurchaseOrderMaster::find($request->id);
        if($purchase_order_master != null){
            $purchase_order_master->is_urgent = true;
            $purchase_order_master->last_updated_by = Auth::id();

            if($purchase_order_master->save()){
                return true;
            }
            return null;
        }
        return null;
    }

    public function makeRevise(Request $request){
        $purchase_order_master = PurchaseOrderMaster::find($request->id);
        if($purchase_order_master != null){
            $purchase_order_master->is_revised = true;
            $purchase_order_master->last_revise_date = Carbon::now();
            $purchase_order_master->last_updated_by = Auth::id();

            if($purchase_order_master->save()){
                return true;
            }
            return null;
        }

        return null;
    }

    public function saveDetail(Request $request){

        $id = $request->get('item_id');
        if(!empty($id)){
            $detail = new CartoonPurchaseOrderDetail();

            if($detail->save()){
                return 'save';
            }
        }
        else{
            $detail = new CartoonPurchaseOrderDetail();

            if($request->is_board == 0){

                //return $request->all();

                $detail->purchase_order_master_id = $request->purchase_order_master_id;
                $detail->item_count = $this->getItemCount($request->purchase_order_master_id);

                $detail->cartoon_product_setup_id = $request->cartoon_product_setup;
                $detail->is_board = $request->is_board;

                $detail->input_unit_id = $request->input_unit;
                $detail->converted_unit_id = $request->conversion_unit;
                $detail->unit_conversion_rate = $request->unit_conversion_rate;

                $detail->length = $request->length;
                $detail->width = $request->width;
                $detail->height = $request->height;
                $detail->extra = $request->extra;
                $detail->length_width = $request->length_width;
                $detail->width_height = $request->width_height;
                $detail->width_height_round = $request->width_height_round;
                $detail->square_meter = $request->square_meter;
                $detail->unit_per_square_meter_price = $request->unit_per_square_meter_price;
                $detail->per_square_meter_price = $request->per_square_meter_price;
                $detail->order_quantity = $request->order_quantity;
                $detail->total_price = ($request->get('total_price'));

                $detail->remarks = $request->item_remarks;

                if($request->get('no_cal') == 'on')
                {
                    $detail->no_cal = true;
                }
                else
                {
                    $detail->no_cal = false;
                }

                if($detail->save()){
                    return 'save';
                }
            }
            else{
                //return $request->all();

                $detail->purchase_order_master_id = $request->purchase_order_master_id;
                $detail->item_count = $this->getItemCount($request->purchase_order_master_id);

                $detail->cartoon_product_setup_id = $request->cartoon_product_setup;
                $detail->is_board = $request->is_board;

                $detail->input_unit_id = $request->input_unit;
                $detail->converted_unit_id = $request->conversion_unit;
                $detail->unit_conversion_rate = $request->unit_conversion_rate;

                $detail->length = $request->length;
                $detail->width = $request->width;
                //$detail->height = $request->height;
                //$detail->extra = $request->extra;
                $detail->length_width = $request->length_width;
                //$detail->width_height = $request->width_height;
                //$detail->width_height_round = $request->width_height_round;
                $detail->square_meter = $request->square_meter;
                $detail->unit_per_square_meter_price = $request->unit_per_square_meter_price;
                $detail->per_square_meter_price = $request->per_square_meter_price;
                $detail->order_quantity = $request->order_quantity;
                $detail->total_price = ($request->get('total_price'));
                $detail->remarks = $request->item_remarks;

                if($request->get('no_cal') == 'on')
                {
                    $detail->no_cal = true;
                }
                else
                {
                    $detail->no_cal = false;
                }



                if($detail->save()){
                    return 'save';
                }
            }

        }


        return null;
    }

    public function getItemCount($masterId){
        $lastDetail = DB::table('cartoon_purchase_order_details')
            ->select('item_count')
            ->where('purchase_order_master_id', $masterId)
            ->get()
            ->last();

        if($lastDetail == null){
            return 1;
        }
        else{
            $lastNumber = $lastDetail->item_count;

            return ($lastNumber+1);
        }
    }

    /*//private function getLPDPoNo(){
        $lastLpd = DB::table('purchase_order_masters')
            ->select('id', 'lpd_po_no')
            ->where('status', '!=', 'D')
            ->get()
            ->last();

        if($lastLpd == null)
        {
            return 1;
        }
        else{
            $lastNumber = $lastLpd->lpd_po_no;

            return ($lastNumber+1);
        }
    }*/


}