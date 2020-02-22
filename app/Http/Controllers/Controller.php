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

    protected function responseFail($error, $code = 400)
    {
        $this->result['message'] = __('messages.fail');
        $this->result['error'] = $error;
        return response($this->result, $code);
    }

    protected function responseNotFound()
    {
        return $this->responseFail('Data not found.', 404);
    }
}
