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
            ->whereBetween('delivery_timestamp', array(Carbon::now()->subWeek(1)->toDateString(), Carbon::now()->addWeek(2)->toDateString()))
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
}
