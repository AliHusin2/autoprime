<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id'     => ['required', 'exists:brands,id'],
            'category_id'  => ['required', 'exists:categories,id'],
            'name'         => ['required', 'string', 'max:100'],
            'model'        => ['nullable', 'string', 'max:100'],
            'year'         => ['required', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'price'        => ['required', 'integer', 'min:1'],
            'transmission' => ['required', 'in:manual,automatic'],
            'fuel_type'    => ['required', 'string', 'max:50'],
            'mileage'      => ['required', 'integer', 'min:0'],
            'description'  => ['nullable', 'string'],
            'status'       => ['required', 'in:available,sold'],
            'is_featured'  => ['nullable', 'boolean'],
            'images'       => ['nullable', 'array'],
            'images.*'     => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'brand_id.required'    => 'Brand wajib dipilih.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'name.required'        => 'Nama mobil wajib diisi.',
            'year.required'        => 'Tahun wajib diisi.',
            'price.required'       => 'Harga wajib diisi.',
            'images.*.image'       => 'File harus berupa gambar.',
            'images.*.max'         => 'Ukuran foto maksimal 2 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->has('is_featured') ? true : false,
            'mileage'     => $this->mileage ?? 0,
        ]);
    }
}
