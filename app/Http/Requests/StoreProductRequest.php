<?php

namespace App\Http\Requests;

use App\Rules\FieldLangRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price'=>'required|numeric|between:1,10000',
            'stock'=>'required|integer|between:1,10000',
            'discount'=>'required|numeric|between:1,99',
            'colors'=>['required','max:255', new FieldLangRule()],
            'sizes'=>['required','max:255', new FieldLangRule()]
        ];
    }

    public function attributes()
    {
        return [
            'category_id'=>'Kateqoriya',
            'name_az'=>'Ad(AZ)',
            'name_en'=>'Ad(EN)',
            'name_ru'=>'Ad(RU)',
            'about_az'=>'Təsvir(AZ)',
            'about_en'=>'Təsvir(EN)',
            'about_ru'=>'Təsvir(RU)',
            'price'=>'Qiymət',
            'stock'=>'Say',
            'discount'=>'Endirim',
            'colors'=>'Rənglər',
            'sizes'=>'Ölçülər'
        ];
    }
}
