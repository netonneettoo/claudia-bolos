<?php

namespace App\Http\Controllers\Api;

use App\CakeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;

class ApiController extends Controller
{
    public function getOpenedCakeRequests() {

        $cakeRequests = CakeRequest::where('status', CakeRequest::OPENED)
            ->whereBetween('delivery_timestamp', array(Carbon::now()->toDateString(), Carbon::now()->addYear()->toDateString()))
            ->get();

        $data = array();
        foreach($cakeRequests as $cakeRequest) {
            $obj = new \stdClass();
            $obj->id = $cakeRequest->id;
            $obj->title = '#'.$cakeRequest->id.' - '.$cakeRequest->client_name;
            $obj->start = $cakeRequest->delivery_timestamp;
            $obj->allDay = true;
            $obj->url = '/admin/cake-requests/'.$cakeRequest->id;
            $obj->color = CakeRequest::getColorByStatus($cakeRequest->status);
            $obj->textColor = CakeRequest::getTextColorByStatus($cakeRequest->status);
            $data[] = $obj;
        }

        return $data;
    }

    public function deleteCakeImage(Request $request) {
        try {
            $cakeRequest = CakeRequest::find(intval($request->get('id')));
            $cakeRequest->cake_image = null;
            if ($cakeRequest->save()) {
                return response()->json(array('code'=>200, 'message'=>'success'), 200);
            } else {
                throw new \Exception('Não foi possível excluir esta imagem', 500);
            }
        } catch (\Exception $e) {
            return response()->json(array('code'=>$e->getCode(), 'message'=>$e->getMessage()), 500);
        }
    }
}
