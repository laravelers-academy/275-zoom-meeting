<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {

        // Definición de la cuenta

        $account = Account::findOrFail($this->account_id);

        $env = [
            'account' => $account->account,
            'client' => $account->client,
            'secret' => $account->secret
        ];

        // Parámetros para la creación de la reunión

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
            //
        ];

    }

}
