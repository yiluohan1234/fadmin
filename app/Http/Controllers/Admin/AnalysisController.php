<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analysis;
use DB;

class AnalysisController extends Controller
{
    protected $data = [];
    //出账用户人数分布情况
    public function users()
    {
        $month = Analysis::select(DB::raw('DISTINCT month_id as month_id'))->orderBy('month_id', 'desc')->get();
        $this->data['title'] = 'analysis_users';
        $this->data['month'] = $month;
        return view('fadmin.analysis.users', $this->data);
    }
    public function udata(Request $request)
    {
        $input = $request->all();
        $time = $input['time'];

        $data = Analysis::where("month_id", $time)->orderBy('user_num', 'desc')->orderBy('month_id', 'desc')->get();
        return $data;
    }
    public function fees()
    {
        $month = Analysis::select(DB::raw('DISTINCT month_id as month_id'))->orderBy('month_id', 'desc')->get();
        $this->data['title'] = 'analysis_fees';
        $this->data['month'] = $month;
        return view('fadmin.analysis.fees', $this->data);
    }
    public function fdata(Request $request)
    {
        $input = $request->all();
        $time = $input['time'];

        $data = Analysis::where("month_id", $time)->orderBy('total_fee', 'desc')->get();
        return $data;
    }
    public function dou()
    {
        $month = Analysis::select(DB::raw('DISTINCT month_id as month_id'))->orderBy('month_id', 'desc')->get();
        $this->data['title'] = 'analysis_fees';
        $this->data['month'] = $month;
        return view('fadmin.analysis.dou', $this->data);
    }
    public function ddata(Request $request)
    {
        $input = $request->all();
        $time = $input['time'];

        $data = Analysis::where("month_id", $time)->orderBy('dou_per_user', 'desc')->get();
        return $data;
    }
}
