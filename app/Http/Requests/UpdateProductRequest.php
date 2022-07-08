<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id'=>'required|exists:categories,id',
            'name_az'=>'required|max:255',
            'name_en'=>'required|max:255',
            'name_ru'=>'required|max:255',
            'about_az'=>'required|max:10000',
            'about_en'=>'required|max:10000',
            'about_ru'=>'required|max:10000',
            'price'=>'numeric|between:1,10000',
            'stock'=>'numeric|between:1,10000',
        ];
    }

    public function attributes()
    {
        return [
            'category_id'=>'Kateqoriya',
            'name_az'=>'Ad(AZ)',
            'name_en'=>'Ad(EN)',
            'name_ru'=>'Ad(RU)',
            'about_az'=>'Haqqımızda(AZ)',
            'about_en'=>'Haqqımızda(EN)',
            'about_ru'=>'Haqqımızda(RU)',
            'price'=>'Qiymət',
            'stock'=>'Say',
        ];
    }
}
