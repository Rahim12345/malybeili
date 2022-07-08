<?php

namespace App\Http\Requests;

use App\Rules\TelRule;
use App\Rules\UnvanRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
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
            'unvan'=>['nullable','max:200', new UnvanRule()],
            'tel'=>['nullable','max:50', new TelRule()],
            'email'=>'nullable|email',
            'facebook'=>'nullable|url|max:150',
            'instagram'=>'nullable|url|max:150',
            'youtube'=>'nullable|url|max:150'
        ];
    }

    public function attributes()
    {
        return [
            'unvan'=>__('static.unvan'),
            'tel'=>'Telefon',
            'email'=>'E-mail',
            'facebook'=>'Facebook',
            'instagram'=>'İnstagram',
            'youtube'=>'Youtube'
        ];
    }
}
