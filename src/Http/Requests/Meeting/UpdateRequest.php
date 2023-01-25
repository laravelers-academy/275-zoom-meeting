<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        
        // Dar formato a la fecha

        $startTime = Carbon::parse($this->start_time)->toIso8601ZuluString();

        $this->merge([
            'start_time' => $startTime
        ]);

        $params = $this->only([
            'topic',
            'start_time',
            'duration',
            'timezone',
            'password'
        ]);

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
            'params' => $params,
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
            'meeting_id' => 'required',
        ];
    }

}
