<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        // PENDIENTE: Validar que las credenciales sean válidas para una cuenta de Zoom
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'account' => 'required',
            'client' => 'required',
            'secret' => 'required',
            'owner_id' => 'required',
        ];
    }

}
