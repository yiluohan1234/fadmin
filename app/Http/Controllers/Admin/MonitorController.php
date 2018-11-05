<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitor;
use App\Models\Statics;
use EasyWeChat\Factory;
use App\Models\Logging;
use Illuminate\Support\Facades\Storage;
use App\Orgs\LoggingV;

class MonitorController extends Controller
{
    public function run()
    {
        $path = public_path();
        $command_file = 'uploads/python/test.py';
        $file = $path. '/' . $command_file;
        $command = 'python ' . $file;
        $output = exec($command, $data);


        return $data;
    }

    public function test()
    {
        $cell = array(
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 54]
        );
        $data = \Lava::DataTable();
        $data->addDateColumn('Year')
            ->addNumberColumn('Sales')
            ->addNumberColumn('Expenses')
            ->setDateTimeFormat('Y')
            ->addRows($cell);

        \Lava::ColumnChart('Stocks', $data, [
          'title' => 'Stock Market Trends'
        ]);
        return view('test', compact('Stocks'));
    }
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
        LoggingV::info('monitor', '数据更新列表');
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
        LoggingV::info('monitor', '图片展示');
        $this->data['title'] = 'picture';
        return view('fadmin.monitor.picture', $this->data);
    }
    //数据近七日更新情况的数据获取
    public function odata()
    {
        $odata = Monitor::where("file_type", "tanzhen")->orderBy('update_date', 'desc')
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
    //本地磁盘占用情况的数据获取
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
    // 应用日志的展示
    public function logShow()
    {
        LoggingV::info('monitor', '应用日志');
        $this->data['title'] = trans('logs.log_show');
        return view('fadmin.monitor.logShow', $this->data);
    }
    // 应用日志的数据获取
    public function logdata()
    {
        $odata = Logging::all();
        $data = array_reverse($odata->toArray(),false);
        return $data;
    }
}
