<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChinesePlaylistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cn_name' => 'required',
            'vn_name' => 'required',
            'artist' => 'required',
            'mp3_url' => 'required|active_url',
            'image_url' => 'required|active_url',
            'color' => 'nullable',
        ];
    }
}
