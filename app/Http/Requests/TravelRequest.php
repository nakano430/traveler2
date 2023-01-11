<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'travel_day'  => 'required',
            'region' => 'prohibited_if:region,null',
            'prefecture'  => 'prohibited_if:prefecture,null'
        ];
    }
    public function messages()
    {
        return [
            'travel_day.required' => '旅行日をご選択ください。',
            'region.prohibited_if' => '旅行方面をご選択ください。',
            'prefecture.prohibited_if' => '都道府県をご選択ください。'
        ];
    }
}
