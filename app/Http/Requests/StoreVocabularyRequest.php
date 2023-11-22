<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVocabularyRequest extends FormRequest
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
            'word_uz'      => 'required|string',
            'word_en'      => 'required|string',
            'description'  => 'required|string|max:255',
            'vocab_photos' => 'mimes:jpeg,jpg,png,svg',
        ];
    }

    public function messages()
    {
        return [
            'word_uz.required'     => "Biror so'z nomini yozing",
            'word_uz.string'       => "Matn ko'rinishida bo'lishi lozim",
            'word_en.required'     => "the word is not entered",
            'word_en.string'       => "Matn ko'rinishida bo'lishi lozim",
            'description.required' => "bu haqida ma'lumot kiritlmadi",
            'description.string'   => "malumot matn ko'rinishida bo'lishi kerak",
            'description.max'      => "malumot 255 so'zdan ortmasligi kerak",
            'vocab_photos.mimes'   => "rasm jpeg,jpg,png yoki svg ko'rinishda b'lishi kerak",
        ];
    }
}
