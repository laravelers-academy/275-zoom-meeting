<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {

        $account = Account::findOrFail($this->account_id);

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
