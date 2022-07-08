<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SebetRequest extends FormRequest
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
            'id'=>'required|exists:products,id',
            'count'=>'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'id'=>'Product',
            'count'=>__('static.sayi'),
        ];
    }
}
