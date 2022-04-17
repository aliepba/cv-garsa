<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_pegawai' => 'unique:pegawai, no_pegawai',
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'kelamin' => 'required',
            'kontak' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan_id' => 'required',
            'photo' => 'required'
        ];
    }
}
