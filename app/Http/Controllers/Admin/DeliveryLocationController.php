<?php

namespace App\Http\Controllers\Admin;

//use App\CRUD\Update;
use App\Http\Controllers\Controller;
use App\Model\DeliveryLocation;
use App\Model\DeliveryLocationDetail;
use App\Model\PurchaseOrderMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryLocationController extends Controller
{
    public function index(){
        $factories = DeliveryLocation::orderBy('name')
            ->where('status', 'A')
            ->get();

       /* // this section for new detail data setup
        foreach ($factories as $factory){
            $detail = new DeliveryLocationDetail();
            $detail->delivery_location_id = $factory->id;
            $detail->contact_person_info = $factory->contact_person_info;
            $detail->save();
        }
        // this section for new detail data setup

        // this section for po updates
        $pos = PurchaseOrderMaster::all();
        foreach ($pos as $factory){

          $detail = PurchaseOrderMaster::find($factory->id);

          $dDetail = DB::table('delivery_location_details')
                    ->where('delivery_location_details.delivery_location_id', $detail->delivery_location_id)
                    ->first();
          $detail->delivery_location_detail_id = $dDetail->id;
          //$detail->contact_person_info = $factory->contact_person_info;
          $detail->save();
        }*/


        return view('admin.delivery-location.index', compact('factories'));
    }

    public function saveFactory(Request $req)
    {
        $HiddenFactoryID = $req->get('id');
        //$DataUpdate = new Update();
        if(!empty($HiddenFactoryID))
        {
            $factory = DeliveryLocation::find($HiddenFactoryID);
            if(!empty($factory)){
                $factory->name = $req->get('name');
                $factory->short_name = $req->get('short_name');
                $factory->address = $req->get('address');
//                $factory->contact_person_info = $req->get('contact_person_info');
                if($factory->save())
                {
                    return 'Updated';
                }
            }
            return null;
        }
        else
        {
            $factory = new DeliveryLocation();
            $factory->name = $req->get('name');
            $factory->short_name = $req->get('short_name');
            $factory->address = $req->get('address');
//            $factory->contact_person_info = $req->get('contact_person_info');
            if($factory->save())
            {
                return 'Saved';
            }
        }

        return 'BR';

    }

    public function detail($id){

        $master = DeliveryLocation::find($id);
        if($master != null){
            if($master->status == 'A'){
                $details = DeliveryLocationDetail::where('delivery_location_id', $id)
                    ->orderBy('contact_person_info')
                    ->get();

                //return $details;

                return view('admin.delivery-location.detail', compact('details', 'master'));
            }
            return redirect()->to('admin.delivery-location');
        }

        return redirect()->to('admin.delivery-location');
    }

    public function saveDetail(Request $req){
        $HiddenFactoryID = $req->get('id');
        //$DataUpdate = new Update();
        if(!empty($HiddenFactoryID))
        {
            $factory = DeliveryLocationDetail::find($HiddenFactoryID);
            if(!empty($factory)){

                $factory->contact_person_info = $req->get('contact_person_info');
                if($factory->save())
                {
                    return 'Updated';
                }
            }
            return null;
        }
        else
        {
            $detail = new DeliveryLocationDetail();
            $detail->delivery_location_id = $req->delivery_location_id;
            $detail->contact_person_info = $req->contact_person_info;
            $detail->save();
            if($detail->save())
            {
                return 'Saved';
            }
        }

        return 'BR';

    }

    public function updateDetail(Request $req){
        $factory = DeliveryLocationDetail::find($req->id);
        $factoryData = array(
            'delivery_location_id' => $factory->delivery_location_id,
            'contact_person_info' => $factory->contact_person_info,
            'id' => $factory->id
        );
        return $factoryData;
    }
    public function updateFactory(Request $req)
    {
        $factory = DeliveryLocation::find($req->id);

        $factoryData = array(
            'name' => $factory->name,
            'short_name' => $factory->short_name,
            'address' => $factory->address,
//            'contact_person_info' => $factory->contact_person_info,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public function contactPersonList(Request $req)
    {
        $DropDownData = DB::table("delivery_location_details")
            ->where("delivery_location_id", $req->delivery_location_id)
            ->pluck("contact_person_info","id");
        return json_encode($DropDownData);
    }

    public function deleteLocation(Request $request){
        $buyer = DeliveryLocation::find($request->id);
        if($buyer != null){
            $buyer->status = 'D';
            if($buyer->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }
}
