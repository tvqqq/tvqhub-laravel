<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChineseNameRequest;
use Helper;
use Illuminate\Http\Request;

class ChineseNameController extends Controller
{
    const PARTNER_URL = 'https://tiengtrunganhduong.com/quiz/translate-name?name=';

    public function index(ChineseNameRequest $request)
    {
        $validated = $request->validated();
        $name = str_replace(' ', '+', $validated['name']);
        $response = Helper::guzzle(
            'GET',
            self::PARTNER_URL . $name
        );
        return $this->response(['success' => true, 'data' => $response->data]);
    }
}
