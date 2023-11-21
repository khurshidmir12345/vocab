<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"=> 'required|max:255',
            "email"=> 'required|unique:users',
            "password"=> 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>"ism kiritilmadi",
            "name.max"=>"qisqa ism kiriting",
            "email.required"=>"email kiritilmadi",
            "email.unique"=>"Bunday email kiritilgan",
            "password.required"=>"password kiriting",
            "password.min"=>"password 6 tadan kam bo'masligi kerak",
        ];
    }
}
