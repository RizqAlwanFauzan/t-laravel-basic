<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nama'      => 'required',
            'tgl_lahir' => 'required|date',
            'jekel'     => 'required',
            'alamat'    => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'      => 'Kolom nama harus diisi!',
            'tgl_lahir.required' => 'Kolom tanggal lahir harus diisi!',
            'tgl_lahir.date'     => 'Kolom tanggal lahir harus diisi dengan format tanggal yang benar!',
            'jekel.required'     => 'Kolom jenis kelamin harus diisi',
            'alamat.required'    => 'Kolom alamat harus diisi'
        ];
    }
}
