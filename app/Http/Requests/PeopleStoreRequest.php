<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PeopleStoreRequest extends FormRequest
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
            'device_id' => 'required|unique:people,device_id',
            'player_id' => 'required|unique:people,player_id'
        ];
    }

    public function messages(): array
    {
        return [
            'device_id.required' => 'device_id boş bırakılamaz.',
            'device_id.unique' => 'device_id zaten sistemde kayıtlı.',
            'player_id.required' => 'player_id boş bırakılamaz.',
            'player_id.unique' => 'player_id zaten sistemde kayıtlı.',
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->first()
        ]));
    }
}
