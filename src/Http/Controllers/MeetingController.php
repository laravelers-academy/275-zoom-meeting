<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Controllers;

use LaravelersAcademy\ZoomMeeting\Facades\Meeting as ZoomMeeting;
use LaravelersAcademy\ZoomMeeting\Models\Meeting;
use Illuminate\Http\Request;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting\ShowRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting\CreateRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting\UpdateRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting\DeleteRequest;

class MeetingController extends Controller
{

    public function __construct()
    {

        $this->middleware(config('zoom.middlewares'));

    }
    
    public function show(Meeting $meeting, ShowRequest $request)
    {

        $zoomMeeting = ZoomMeeting::set($request->env)
                            ->get($meeting->payload['id']); 

        return [
            'meeting' => $meeting,
            'join_url' => $zoomMeeting['join_url']
        ];

    }

    public function create(CreateRequest $request)
    {   

        $zoomMeeting = ZoomMeeting::set($request->env)
                            ->create($request->params);

        return Meeting::create([
            'payload' => $zoomMeeting,
            'account_id' => $request->account_id
        ]);

    }

    public function update(Meeting $meeting, UpdateRequest $request)
    {

        $zoomMeeting = ZoomMeeting::set($request->env)
                            ->update($meeting->payload['id'], $request->params);

        return $meeting->update([
            'payload' => $zoomMeeting
        ]);

    }

    public function delete(Meeting $meeting, DeleteRequest $request)
    {

        $zoomMeeting = ZoomMeeting::set($request->env)
                            ->delete($meeting->payload['id']);

        return $meeting->delete();

    }

}
