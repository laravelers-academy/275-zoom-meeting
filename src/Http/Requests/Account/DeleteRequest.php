<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }

}
