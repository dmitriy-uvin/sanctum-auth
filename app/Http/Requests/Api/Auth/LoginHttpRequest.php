<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiFormRequest;

class LoginHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ];
    }
}
