<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CakeRequest extends Model
{
    const OPENED = 'opened';
    const CLOSED = 'closed';
    const CANCELLED = 'cancelled';
    const EXCLUDED = 'excluded';

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
                return 'black';
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
}
