<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CakeRequest extends Model
{
    const OPENED = 'opened';
    const CLOSED = 'closed';
    const CANCELLED = 'cancelled';
    const EXCLUDED = 'excluded';

    protected $fillable = [
        'delivery_timestamp',
        'cake_image',
        'client_name',
        'client_phone',
        'client_mobile',
        'estimated_price',
        'payment_value',
        'status',
        'note'
    ];

    protected $rules = [
        'delivery_timestamp'    => 'required',
        'client_name'           => 'required',
        'client_phone'          => 'min:14|max:16',
        'client_mobile'         => 'min:14|max:16',
        'estimated_price'       => 'required',
        'status'                => 'required',
    ];

    protected $rulesPut = [
        'client_phone'          => 'min:14|max:16',
        'client_mobile'         => 'min:14|max:16'
    ];

    protected $messages = [];
    protected $messagesPut = [];

    public function validate($data) {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'put' || strtolower($_SERVER['REQUEST_METHOD']) == 'patch') {
            return Validator::make($data, $this->rulesPut, $this->messagesPut);
        } else {
            return Validator::make($data, $this->rules, $this->messages);
        }
    }

    public function put($data, $id) {
        $obj = CakeRequest::find($id);
        if (@isset($data['delivery_timestamp']) && $data['delivery_timestamp'] != null)
            $obj->delivery_timestamp = $data['delivery_timestamp'];

        if (@isset($data['client_name']) && $data['client_name'] != null)
            $obj->client_name = $data['client_name'];

        if (@isset($data['client_phone']) && $data['client_phone'] != null)
            $obj->client_phone = $data['client_phone'];

        if (@isset($data['client_mobile']) && $data['client_mobile'] != null)
            $obj->client_mobile = $data['client_mobile'];

        if (@isset($data['estimated_price']) && $data['estimated_price'] != null)
            $obj->estimated_price = $data['estimated_price'];

        if (@isset($data['payment_value']) && $data['payment_value'] != null)
            $obj->payment_value = $data['payment_value'];

        if (@isset($data['status']) && $data['status'] != null)
            $obj->status = $data['status'];

        if (@isset($data['note']) && $data['note'] != null)
            $obj->note = $data['note'];

        return $obj;
    }

    public static function getColorByStatus($status) {
        switch ($status) {
            case self::OPENED:
                return '#1ab394';
                break;
            case self::CLOSED:
                return '#d9534f';
                break;
            case self::CANCELLED:
                return '#f0ad4e';
                break;
            case self::EXCLUDED:
                return '#cccccc';
                break;
        }
    }

    public static function getTextColorByStatus($status) {
        switch ($status) {
            case self::OPENED:
                return '#ffffff';
                break;
            case self::CLOSED:
                return '#ffffff';
                break;
            case self::CANCELLED:
                return '#ffffff';
                break;
            case self::EXCLUDED:
                return '#000000';
                break;
        }
    }

    public function getStatusName() {
        switch ($this->status) {
            case self::OPENED:
                return 'Aberto';
                break;
            case self::CLOSED:
                return 'Fechado';
                break;
            case self::CANCELLED:
                return 'Cancelado';
                break;
            case self::EXCLUDED:
                return 'Excluído';
                break;
        }
    }

    public function getClassByStatus() {
        switch ($this->status) {
            case self::OPENED:
                return 'primary';
                break;
            case self::CLOSED:
                return 'danger';
                break;
            case self::CANCELLED:
                return 'warning';
                break;
            case self::EXCLUDED:
                return 'default';
                break;
        }
    }

    public function getDeliveryTimestamp() {
        return date("d/m/Y", strtotime($this->delivery_timestamp));
    }

    public function getEstimatedPrice() {
        return 'R$ ' . number_format($this->estimated_price, 2, ',', '.');
    }

    public function getPaymentValue() {
        return 'R$ ' . number_format($this->payment_value, 2, ',', '.');
    }

    public static function uploadCakeImage(UploadedFile $cakeImageTemp) {

        try {

            $path = base_path('\public\uploads');

            if (! (file_exists($path) && is_dir($path))) {
                mkdir($path, 0755);
            }

            $filename = md5(bcrypt(str_random(10))) . '.' . $cakeImageTemp->getClientOriginalExtension();
            $url = '/uploads/' . $filename;

            $cakeImageTemp->move($path, $filename);

            return $url;

        } catch (\Exception $e) {
            return null;
        }
    }
}
