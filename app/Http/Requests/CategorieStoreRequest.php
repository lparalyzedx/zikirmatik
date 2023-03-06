<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:categories,name'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kategori adı boş bırakılamaz.',
            'name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'name.unique' => 'Kategori adı zaten mevcut.'
        ];
    }
}
