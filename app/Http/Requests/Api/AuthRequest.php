<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->isMethod( 'post') && $this->routeIs( 'login')){
             return [
                //règle de validation du formulaire
                'email' =>'required|string|email',
                'password' => 'required|string',
            ];
        }
        return [
            //
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Un email est nécéssaire pour se connecter',
            'password.required' => 'Un mot de passe est requis pour se connecter',
        ];
    }
}
