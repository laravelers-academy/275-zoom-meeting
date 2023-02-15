<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Controllers;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use Illuminate\Http\Request;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\ShowRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\CreateRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\UpdateRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\DeleteRequest;

class AccountController extends Controller
{

    public function __construct()
    {

        $this->middleware(config('zoom.middlewares'));

    }
    
    public function show(Account $account, ShowRequest $request)
    {

        return $account;

    }

    public function create(CreateRequest $request)
    {

        return Account::create($request->all());

    }

    public function update(Account $account, UpdateRequest $request)
    {

        return $account->update($request->all());

    }

    public function delete(Account $account, DeleteRequest $request)
    {

        return $account->delete();

    }

}
