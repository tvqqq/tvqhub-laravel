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

    protected function response($response, $meta = null)
    {
        if (!empty($response['success'])) {
            return $this->responseSuccess($response['data'], $meta);
        } else {
            return $this->responseFail($response['message']);
        }
    }

    private function responseSuccess($data, $meta = null)
    {
        $this->result = [
            'success' => true,
            'message' => __('messages.success'),
            'data' => $data,
            'meta' => $meta
        ];
        return response($this->result, 200);
    }

    private function responseFail($message, $code = 200)
    {
        $this->result['message'] = $message;
        return response($this->result, $code);
    }

    protected function responseNotFound()
    {
        return $this->responseFail('Data not found.', 404);
    }
}
