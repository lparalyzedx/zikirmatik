<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'version' => 'required|max:255',
        ];
    }

    public function messages() : array
    {
         return [
          'version.required' => 'Version boş bırakılamaz.',
          'version.max'  => 'Version en fazla 255 karakter olabilir.'
         ];
    }
}
