<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {

        $env = [];

        if(!config('zoom.use_default_env')){

            $account = Account::find($this->account_id);

            $env = [
                'account' => $account->account,
                'client' => $account->client,
                'secret' => $account->secret
            ];

        }

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
