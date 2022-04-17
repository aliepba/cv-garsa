<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'id_absen' => 'required',
            'no_pegawai' => 'required',
            'upah_id' => 'required',
            'jumlah' => 'required',
            'tanggal_hadir' => 'required'
        ];
    }
}
