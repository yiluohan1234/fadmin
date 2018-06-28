<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitor;
use App\Models\Statics;
use EasyWeChat\Factory;

class MonitorController extends Controller
{
    // 地图展示
    public function map()
    {
        $this->data['title'] = 'map';
        return view('fadmin.monitor.map', $this->data);
    }
    public function mdata()
    {
        $data = [];
        $provinces = ['011', '013', '018', '019', '010', '091', '090', '097', '031', '034', '036', '030', '038', '075', '017', '076', '071', '074', '051', '059', '050', '083', '081', '085', '086', '079', '084', '087', '070', '088', '089'];
        //0
        foreach($provinces as $p){
            $tmp = Statics::where("prov_id", $p)->orderBy('service_type')->get();
            array_push($data, [$tmp[0]->user_num, $tmp[1]->user_num, $tmp[2]->user_num, $tmp[3]->user_num,$tmp[4]->user_num, $tmp[0]->user_num+$tmp[1]->user_num+$tmp[2]->user_num+$tmp[3]->user_num+$tmp[4]->user_num]);
        }
        return $data;
    }
    public function mddata(Request $request)
    {
        $input = $request->all();
        $time = $input['time'];
        $data = [];
        $provinces = ['011', '013', '018', '019', '010', '091', '090', '097', '031', '034', '036', '030', '038', '075', '017', '076', '071', '074', '051', '059', '050', '083', '081', '085', '086', '079', '084', '087', '070', '088', '089'];
        $tmp = Statics::where("month_id", $time)->where('service_type', '0')->orderBy('user_num', 'desc')->get();
        return $tmp;
    }
    // 监控表格的展示
    public function table()
    {
        $this->data['title'] = trans('monitor.monitor_data');
        return view('fadmin.monitor.table', $this->data);
    }
    // 监控表格的数据获取
    public function tabledata()
    {
        $odata = Monitor::all();
        $data = array_reverse($odata->toArray(),false);
        return $data;
    }
    // 用户近七日更新情况图标展示
    public function picture()
    {
        $this->data['title'] = 'picture';
        return view('fadmin.monitor.picture', $this->data);
    }
    //数据近七日更新情况的数据获取
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
