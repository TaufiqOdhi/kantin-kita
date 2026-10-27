<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PencarianProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['q' => ['nullable', 'string', 'max:100']];
    }

    public function kataKunci(): string
    {
        return trim($this->validated('q') ?? '');
    }

    public function messages(): array
    {
        return ['q.string' => 'Pencarian harus berupa teks.', 'q.max' => 'Pencarian maksimal 100 karakter.'];
    }
}
