<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Timeline;
use DB;

class PagesController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(fadmin_middleware());
    }
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $timeline = [];
        $time = DB::select("SELECT distinct(date_format(created_at, '%Y-%m')) as time FROM timelines order by time desc");
        foreach($time as $t){
            array_push($timeline,[$t->time => Timeline::where('date', 'like', "$t->time%")->orderBy('created_at', 'desc')->get()]);
        }
        $this->data['title'] = trans('base.dashboard'); // set the page title
        $this->data['timeline'] = $timeline;
        return view('fadmin.dashboard', $this->data);
    }
    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(fadmin_url('dashboard'));
    }
}
