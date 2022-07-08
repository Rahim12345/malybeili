<?php

namespace App\Http\Requests;

use App\Rules\FieldLangRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'foto'=>'nullable|image|max:2048',
            'name'=>['required','max:255',new FieldLangRule()],
            'review'=>['required','max:1000',new FieldLangRule()],
        ];
    }

    public function attributes()
    {
        return [
            'foto'=>'Foto',
            'name'=>'Name(az***en***ru)',
            'review'=>'Name(az***en***ru)',
        ];
    }
}
