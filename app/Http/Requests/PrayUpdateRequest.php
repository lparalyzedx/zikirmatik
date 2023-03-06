<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrayUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|unique:prays,name,'.$this->id.',id',
            'description' => 'required',
            'categorie_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Dua adı boş bırakılamaz.',
            'name.max' => 'Dua adı en fazla 255 karakter olmalıdır.',
            'name.unique' => 'Dua adı zaten mevcut.',
            'description.required' => 'Dua boş bırakılamaz.',
            'categorie_id.required' => 'Lütfen kategori seçiniz.',
            'categorie_id.exists' => 'Kategori bulunamadı.'
        ];
    }
}
