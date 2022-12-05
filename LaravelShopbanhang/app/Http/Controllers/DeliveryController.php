<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province; 
use App\Wards;
use App\FeeShip;

class DeliveryController extends Controller
{
	public function update_delivery(Request $request){
        $fee_id = $request->all();
		$data = Feeship::find($fee_id['fee_id']);
		$fee_feeship = rtrim($fee_id['fee_feeship'],'.');
		$data->fee_feeship = $fee_feeship;
		$data->save();

	}


	public function select_feeship(){
		$feeship = Feeship::orderby('fee_id','DESC')->get();
		$output = '';
		$output .= '<div class="table-responsive">
            <table class="table table-bordered">
            <thread>
               <tr>
                  <th>Tên thành phố</th>
                  <th>Tên Quận huyện</th>
                  <th>Tên xã phường</th>
                  <th>Phí ship</th>
               </tr>
            </thread>
            <tbody>  ';
            foreach($feeship as $key => $fee){
            $output .='
                <tr>
                   <td>'.$fee->city->name_city.'</td>
                   <td>'.$fee->province->name_quanhuyen.'</td>
                   <td>'.$fee->wards->name_xaphuong.'</td>
                   <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
                </tr>';

                }
        $output .= '</tbody>
            </table>
            </div>	';
            echo $output;
	}

	public function insert_delivery(Request $request){
		$data = $request->all(); 
		$fee_ship = new FeeShip();
		$fee_ship->fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();
     
	}
    public function delivery(Request $request){
    	$city = City::orderby('matp','ASC')->get();
    	return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=='city'){
    			$select_province = Province::where('matp',$data['ma_value'])->orderby('maqh','ASC')->get();
    			$output.= '<option>--Chọn quận huyên--</option>';
    			foreach($select_province as $key => $province){
    			$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}	
    		}else{
    			$select_wards = Wards::where('maqh',$data['ma_value'])->orderby('xaid','ASC')->get();
    			$output.= '<option>--Chọn xã phường--</option>';
    			foreach($select_wards as $key => $wards){
    			$output.= '<option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
    			}
    		}
    	}
    	echo $output;
    }
}
