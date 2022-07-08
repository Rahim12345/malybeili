<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignRequest extends FormRequest
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
        if (request()->action == 'registration')
        {
            return [
                'registerEmail'             => 'required|email|max:255|unique:users,email',
                'registerPassword'          => 'min:8|max:200|required_with:registerRepeatPassword|same:registerRepeatPassword',
                'registerRepeatPassword'    => 'min:8'
            ];
        }
        elseif (request()->action == 'login')
        {
            return [
                'loginEmail'                => 'required|email',
                'loginPassword'             => 'required'
            ];
        }
        else
        {
            return [
                'action'=>['required', Rule::in(['registration', 'login'])]
            ];
        }
    }

    public function attributes()
    {
        return [
            'registerEmail'             =>__('login.email'),
            'loginEmail'                =>__('login.email'),
            'registerPassword'          =>__('login.password'),
            'loginPassword'             =>__('login.password'),
            'registerRepeatPassword'    =>__('login.sifre_yanlisdir'),
        ];
    }
}
