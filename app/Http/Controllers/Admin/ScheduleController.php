<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orgs\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = new Schedule();
        $events = $schedule->getTasks();
        //dd(storage_path('app/task-schedule.output'));
        return view('schedule.index', compact('events'));
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
