<?php

namespace App\Listeners;

use App\Events\LogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
use Carbon\Carbon;

class LogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {
        //获取事件中保存的信息
        $user = $event->getUser();
        $agent = $event->getAgent();
        $ip = $event->getIp();
        $action = $event->getAction();
        $timestamp = $event->getTimestamp();

        //登录信息
        $log_info = [
            'user_id' => $user->id,
            'login_time' => Carbon::createFromTimestamp($timestamp)->toDateTimeString(),
            'action' => $action,
            'ip' => $ip
        ];

        // zhuzhichao/ip-location-zh 包含的方法获取ip地理位置
        $addresses = \Ip::find($ip);
        $log_info['address'] = implode(' ', $addresses);

        // jenssegers/agent 的方法来提取agent信息
        $log_info['device'] = $agent->device();    //设备名称
        $browser = $agent->browser();
        $log_info['browser'] = $browser . ' ' . $agent->version($browser); //浏览器
        $platform = $agent->platform();
        $log_info['platform'] = $platform . ' ' . $agent->version($platform); //操作系统
        $log_info['language'] = implode('/', $agent->languages());    //语言
        //设备类型
        if ($agent->isTablet()) {
            // 平板
            $log_info['device_type'] = 'tablet';
        } else if ($agent->isMobile()) {
            // 便捷设备
            $log_info['device_type'] = 'mobile';
        } else if ($agent->isRobot()) {
            // 爬虫机器人
            $log_info['device_type'] = 'robot';
            $log_info['device'] = $agent->robot(); //机器人名称
        } else {
            // 桌面设备
            $log_info['device_type'] = 'desktop';
        }
        $log_info['created_at'] = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        //插入到数据库
        DB::table('logs')->insert($log_info);
    }
}
