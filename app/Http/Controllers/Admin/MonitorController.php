<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitor;

class MonitorController extends Controller
{
    public function table()
    {
        $this->data['title'] = trans('monitor.monitor_data');
        return view('fadmin.monitor.table', $this->data);
    }
     public function tabledata()
    {
        $odata = Monitor::all();
        $data = array_reverse($odata->toArray(),false);
        return $data;
    }

    public function picture()
    {
        $this->data['title'] = 'picture';
        return view('fadmin.monitor.picture', $this->data);
    }
    //数据近七日更新情况
    public function odata()
    {
        $odata = Monitor::where("file_type", "O")->orderBy('update_date', 'desc')
                        ->take(7)
                        ->get();
        $odata_v = array_reverse($odata->toArray(),false);
        $ldata = Monitor::where("file_type", "label")->orderBy('update_date', 'desc')
                        ->take(7)
                        ->get();
        $ldata_v = array_reverse($ldata->toArray(),false);

        $result = [
            "O" => $odata_v,
            "label" => $ldata_v
            ];

        return $result;

    }
    //本地磁盘占用情况
    public function filesystem()
    {
        $data = Monitor::where("file_type", "O")->orderBy('update_date', 'desc')
                        ->take(1)
                        ->get();
        $result = [
            [
                "value" => $data[0]->filesystem_used,
                "name" => trans('monitor.Usage')
            ],
            [
                "value"=>$data[0]->filesystem_size,
                "name"=> trans('monitor.Total')
            ]
        ];

        return $result;

    }
}
