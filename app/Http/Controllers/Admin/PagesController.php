<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Timeline;
use DB;
use App\Models\Analysis;
use App\Orgs\LoggingV;

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
        //登录成功，触发事件
        LoggingV::info('login', '用户登录');
        if(getenv('APP_ENV') == 'local'){
            // 时间线，按照月份排序
            $timeline = [];
            $time = DB::select("SELECT distinct(date_format(created_at, '%Y-%m')) as time FROM timelines order by time desc");
            foreach($time as $t){
                array_push($timeline,[$t->time => Timeline::where('date', 'like', "$t->time%")->orderBy('created_at', 'desc')->get()]);
            }
            $this->data['timeline'] = $timeline;
        }

        // 总的数据量
        $file_num = DB::select("select file_type,sum(file_num) as file_num, sum(space_size)/1024/1024 as space_size from monitors group by file_type");
        if(count($file_num) == 0){
            $label_num = 0;
            $O_num = 0;
        }else{
            $label_num = $file_num[0]->file_num;
            $O_num = $file_num[1]->file_num;
        }

        // 最近一个月的用户数，收入，DOU，高价值用户数
        $country_all_data = Analysis::select(DB::raw('month_id, sum(user_num) as user_num, sum(total_fee) as total_fee, (sum(total_traffic)/sum(user_num)) as dou, sum(hightv_user_num) as hightv_user_num, sum(hightv_total_fee) as hightv_total_fee'))
                        ->groupBy('month_id')
                        ->orderBy('month_id', 'desc')
                        ->take(2)
                        ->get();
        if(count($country_all_data) == 0){
            $latest_data_show =
            [
                [
                    'name' => '用户数(亿)',
                    'data' => 0,
                    'percentage' => 0
                ],
                [
                    'name' => '收入(亿)',
                    'data' => 0,
                    'percentage' => 0
                ],
                [
                    'name' => '高价值用户(亿)',
                    'data' => 0,
                    'percentage' => 0
                ],
                [
                    'name' => '高价值用户收入(亿)',
                    'data' => 0,
                    'percentage' => 0
                ],
                [
                    'name' => 'DOU(G)',
                    'data' => 0,
                    'percentage' => 0
                ]
            ];
        }else{
            $latest_data_show =
            [
                [
                    'name' => '用户数(亿)',
                    'data' => round($country_all_data[0]->user_num/10000/10000, 2),
                    'percentage' => round(($country_all_data[0]->user_num -$country_all_data[1]->user_num)*100/$country_all_data[1]->user_num, 2)
                ],
                [
                    'name' => '收入(亿)',
                    'data' => round($country_all_data[0]->total_fee/10000/10000, 2),
                    'percentage' => round(($country_all_data[0]->total_fee - $country_all_data[1]->total_fee)*100/$country_all_data[1]->total_fee, 2)
                ],
                [
                    'name' => '高价值用户(亿)',
                    'data' => round($country_all_data[0]->hightv_user_num/10000/10000, 2),
                    'percentage' => round(($country_all_data[0]->hightv_user_num - $country_all_data[1]->hightv_user_num)*100/$country_all_data[1]->hightv_user_num,2)
                ],
                [
                    'name' => '高价值用户收入(亿)',
                    'data' => round($country_all_data[0]->hightv_total_fee/10000/10000, 2),
                    'percentage' => round(($country_all_data[0]->hightv_total_fee - $country_all_data[1]->hightv_total_fee)*100/$country_all_data[1]->hightv_total_fee,2)
                ],
                [
                    'name' => 'DOU(G)',
                    'data' => round($country_all_data[0]->dou/1024, 2),
                    'percentage' => round(($country_all_data[0]->dou - $country_all_data[1]->dou)*100/$country_all_data[1]->dou,2)
                ]
            ];
        }
        $this->data['title'] = trans('base.dashboard'); // set the page title
        $this->data['O_num'] = $O_num;
        $this->data['label_num'] = $label_num;
        $this->data['month_id'] = empty($country_all_data)?0:$country_all_data[0]->month_id;
        $this->data['latest_data_show'] = $latest_data_show;


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
    /**
     * 用户收入和高价值用户收入的原始数据
     * return:
     *     [
     *         fee => [
     *                 [
     *                     monthid => '201801',
     *                     total_fee => '28'
     *                 ],
     *                 ...
     *
     *         ],
     *         fee_v =>[
     *                 [
     *                     monthid => '201801',
     *                     hightv_total_fee => '28'
     *                 ],
     *                 ...
     *         ],
     *
     *     ]
     */
    public function latest_data_of_country()
    {
        //SELECT month_id, sum(total_fee) as total_fee FROM analyses group by month_id ORDER BY month_id desc limit 7
        $odata = Analysis::select(DB::raw('month_id, sum(total_fee) as total_fee'))
                        ->groupBy('month_id')
                        ->orderBy('month_id', 'desc')
                        ->take(6)
                        ->get();

        $odata_v = array_reverse($odata->toArray(),false);
        //SELECT month_id, sum(dou) as dou FROM analyses group by month_id ORDER BY month_id desc limit 7
        $ldata = Analysis::select(DB::raw('month_id, sum(hightv_total_fee) as hightv_total_fee'))
                        ->groupBy('month_id')
                        ->orderBy('month_id', 'desc')
                        ->take(6)
                        ->get();
        $ldata_v = array_reverse($ldata->toArray(),false);

        $result = [
            "fee" => $odata_v,
            "fee_hv" => $ldata_v
            ];

        return $result;
    }
}
