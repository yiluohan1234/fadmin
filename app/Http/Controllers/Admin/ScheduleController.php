<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orgs\Schedule;

class ScheduleController extends Controller
{
    protected $data = [];
    public function index()
    {
        $this->data['title'] = trans('schedule.Task schedules');
        $schedule = new Schedule();
        $events = $schedule->getTasks();
        $this->data['events'] = $events;
        //dd(storage_path('app/task-schedule.output'));
        return view('fadmin.schedule.index', $this->data);
    }
    public function run(Request $request)
    {
        $schedule = new Schedule();

        try {
            $output = $schedule->runTask($request->get('id'));

            return [
                'status'    => true,
                'message'   => 'success',
                'data'      => $output,
            ];
        } catch (\Exception $e) {
            return [
                'status'    => false,
                'message'   => 'failed',
                'data'      => $e->getMessage(),
            ];
        }
    }

}
