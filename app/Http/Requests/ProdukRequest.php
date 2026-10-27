<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Versi belajar lokal; akun dan policy menjadi tugas lanjutan.
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this->input('sku'))) {
            $this->merge(['sku' => Str::upper(trim($this->input('sku')))]);
        }
    }

    public function rules(): array
    {
        $unik = Rule::unique('produk', 'sku');
        if ($produk = $this->route('produk')) {
            $unik->ignore($produk); // Model dari route, bukan ID dari form.
        }

        return [
            'sku' => ['bail', 'required', 'string', 'max:50', $unik],
            'nama' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'integer', 'exists:kategori,id'],
            'harga' => ['required', 'integer', 'min:0', 'max:4294967295'],
            'stok' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus bilangan bulat.',
            'min' => ':attribute minimal :min.',
            'max' => ':attribute melebihi batas :max.',
            'sku.unique' => 'SKU sudah digunakan produk lain.',
            'kategori_id.exists' => 'Kategori tidak ditemukan.',
        ];
    }

    public function attributes(): array
    {
        return ['sku' => 'SKU', 'nama' => 'Nama produk',
            'kategori_id' => 'Kategori', 'harga' => 'Harga', 'stok' => 'Stok'];
    }
}
