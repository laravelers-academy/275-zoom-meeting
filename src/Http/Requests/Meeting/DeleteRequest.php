<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {

        $meeting = Meeting::findOrFail($this->meeting_id);

        $account = $meeting->account;

        $env = [
            'account' => $account->account,
            'client' => $account->client,
            'secret' => $account->secret
        ];

        $this->merge([
            'env' => $env
        ]);

    }

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
