<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $result = [
        'success' => false,
        'message' => ''
    ];

    private function __construct()
    {
        $this->result['message'] = __('messages.fail');
    }

    protected function responseSuccess($data, $meta = null)
    {
        $this->result = [
            'success' => true,
            'message' => __('messages.success'),
            'data' => $data,
            'meta' => $meta
        ];
        return response($this->result, 200);
    }

    protected function responseFail($error)
    {
        $this->result['error'] = $error;
        return response($this->result, 400);
    }
}
