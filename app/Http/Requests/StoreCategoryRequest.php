<?php

namespace App\Http\Requests;

use App\Rules\FieldLangRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            'foto'=>'required|mimes:jpg,jpeg,webp,png|max:2048',
            'text'=>['required','max:255',new FieldLangRule()]
        ];
    }

    public function attributes()
    {
        return [
            'foto'=>'Foto',
            'text'=>'Text'
        ];
    }
}
