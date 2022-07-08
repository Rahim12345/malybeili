<?php

namespace App\Http\Requests;

use App\Rules\FieldLangRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreAboutRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->action == 'update')
        {
            return [
                'foto'=>'nullable|mimes:jpg,jpeg,webp,png|max:2048',
                'text'=>['required','max:1000',new FieldLangRule()],
                'action'=>['required',Rule::in(['create','update'])]
            ];
        }
        return [
            'foto'=>'required|mimes:jpg,jpeg,webp,png|max:2048',
            'text'=>['required','max:1000',new FieldLangRule()],
            'action'=>['required',Rule::in(['create','update'])]
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
