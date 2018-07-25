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
        $this->data['title'] = 'analysis_dou';
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
    public function statics()
    {
        $month = Analysis::select(DB::raw('DISTINCT month_id as month_id'))->orderBy('month_id', 'desc')->get();
        $category = [
            [
                'name' => '用户数',
                'value' => '001'
            ],[
                'name' => '用户人均流量',
                'value' => '002'
            ],[
                'name' => '收入',
                'value' => '003'
            ],[
                'name' => '高价值用户数',
                'value' => '004'
            ],[
                'name' => '高价值用户人均流量',
                'value' => '005'
            ],[
                'name' => '高价值用户收入',
                'value' => '006'
            ]
        ];

        $province = [
            [
                'name' => '全国',
                'value' => '0'
            ],[
                'name' => '内蒙古',
                'value' => '010'
            ],[
                'name' => '北京',
                'value' => '011'
            ],[
                'name' => '天津',
                'value' => '013'
            ],[
                'name' => '山东',
                'value' => '017'
            ],[
                'name' => '河北',
                'value' => '018'
            ],[
                'name' => '山西',
                'value' => '019'
            ],[
                'name' => '澳门',
                'value' => '022'
            ],[
                'name' => '安徽',
                'value' => '030'
            ],[
                'name' => '上海',
                'value' => '030'
            ],[
                'name' => '江苏',
                'value' => '034'
            ],[
                'name' => '浙江',
                'value' => '036'
            ],[
                'name' => '福建',
                'value' => '038'
            ],[
                'name' => '海南',
                'value' => '050'
            ],[
                'name' => '广东',
                'value' => '051'
            ],[
                'name' => '广西',
                'value' => '059'
            ],[
                'name' => '青海',
                'value' => '070'
            ],[
                'name' => '湖北',
                'value' => '070'
            ],[
                'name' => '湖南',
                'value' => '074'
            ],[
                'name' => '江西',
                'value' => '075'
            ],[
                'name' => '河南',
                'value' => '076'
            ],[
                'name' => '西藏',
                'value' => '079'
            ],[
                'name' => '四川',
                'value' => '081'
            ],[
                'name' => '陕西',
                'value' => '084'
            ],[
                'name' => '贵州',
                'value' => '085'
            ],[
                'name' => '重庆',
                'value' => '083'
            ],[
                'name' => '云南',
                'value' => '086'
            ],[
                'name' => '甘肃',
                'value' => '087'
            ],[
                'name' => '宁夏',
                'value' => '088'
            ],[
                'name' => '新疆',
                'value' => '089'
            ],[
                'name' => '吉林',
                'value' => '090'
            ],[
                'name' => '辽宁',
                'value' => '091'
            ],[
                'name' => '黑龙江',
                'value' => '097'
            ]
        ];
        // dd($province);
        $this->data['title'] = 'statics';
        $this->data['month'] = $month;
        $this->data['category'] = $category;
        $this->data['province'] = $province;
        return view('fadmin.analysis.statics', $this->data);
    }
    public function sdata(Request $request)
    {
        $input = $request->all();
        $prov_id = $input['prov'];
        $category_id = $input['category'];
        $month_id = $input['month'];
        if ($prov_id == '0')
        {
            switch($category_id)
            {
                case '001':
                    $data = Analysis::where("month_id", $month_id)->orderBy('user_num', 'desc')->select(DB::raw('prov_id, round(user_num/10000,2) as data'))->get();
                    break;
                case '002':
                    $data = Analysis::where("month_id", $month_id)->orderBy('dou', 'desc')->select(DB::raw('prov_id, round(dou/1024,2) as data'))->get();
                    break;
                case '003':
                    $data = Analysis::where("month_id", $month_id)->orderBy('total_fee', 'desc')->select(DB::raw('prov_id, round(total_fee/10000/10000,2) as data'))->get();
                    break;
                case '004':
                    $data = Analysis::where("month_id", $month_id)->orderBy('hightv_user_num', 'desc')->select(DB::raw('prov_id, round(hightv_user_num/10000,2) as data'))->get();
                    break;
                case '005':
                    $data = Analysis::where("month_id", $month_id)->orderBy('hightv_dou', 'desc')->select(DB::raw('prov_id, round(hightv_dou/1024,2) as data'))->get();
                    break;
                case '006':
                    $data = Analysis::where("month_id", $month_id)->orderBy('hightv_total_fee', 'desc')->select(DB::raw('prov_id, round(hightv_total_fee/10000/10000,2) as data'))->get();
                    break;
            }
        }else
        {
            switch($category_id)
            {
                case '001':
                    $reverse_data = Analysis::where("prov_id", $prov_id)->orderBy('month_id', 'desc')->select(DB::raw('month_id, round(user_num/10000,2) as data'))->take(6)->get();
                    break;
                case '002':
                    $reverse_data = Analysis::where("prov_id", $prov_id)->orderBy('month_id', 'desc')->select(DB::raw('month_id, round(dou/1024,2) as data'))->take(6)->get();
                    break;
                case '003':
                    $reverse_data = Analysis::where("prov_id", $prov_id)->orderBy('month_id', 'desc')->select(DB::raw('month_id, round(total_fee/10000/10000,2) as data'))->take(6)->get();
                    break;
                case '004':
                    $reverse_data = Analysis::where("prov_id", $prov_id)->orderBy('month_id', 'desc')->select(DB::raw('month_id, round(hightv_user_num/10000,2) as data'))->take(6)->get();
                    break;
                case '005':
                    $reverse_data = Analysis::where("prov_id", $prov_id)->orderBy('month_id', 'desc')->select(DB::raw('month_id, round(hightv_dou/1024,2) as data'))->take(6)->get();
                    break;
                case '006':
                    $reverse_data = Analysis::where("prov_id", $prov_id)->orderBy('month_id', 'desc')->select(DB::raw('month_id, round(hightv_total_fee/10000/10000,2) as data'))->take(6)->get();
                    break;
            }
            $data = array_reverse($reverse_data->toArray(),false);
        }

        return $data;
    }
}
