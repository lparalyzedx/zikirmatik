<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyUpdateRequest extends FormRequest
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
            'pray_id' => 'required|exists:prays,id',
            'date'    => 'required|unique:dailies,date,'.$this->id.',id|date|after_or_equal:' . date('Y-m-d')
        ];
    }

    public function messages(): array
    {
        return [
            'pray_id.required' => 'Lütfen kategori seçiniz.',
            'pray_id.exists'  => 'Kategori bulunamadı.',
            'date.required'  => 'Tarih boş bırakılamaz.',
            'date.unique' => 'Bu tarihte dua zaten mevcut.',
            'date.date'   => 'Lütfen geçerli bir tarih giriniz.',
            'date.after_or_equal'   => 'Lütfen geçerli bir tarih giriniz.'
        ];
    }
}
