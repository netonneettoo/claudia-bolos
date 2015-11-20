<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CakeRequest extends Model
{
    const OPENED = 'opened';
    const CLOSED = 'closed';
    const CANCELLED = 'cancelled';
    const EXCLUDED = 'excluded';

    private $model;

    /**
     * CakeRequest constructor.
     */
    public function __construct()
    {
        $this->model = new CakeRequest();
    }
}
