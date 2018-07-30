<?php
namespace App\Orgs;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Zhuzhichao\IpLocationZh\Ip;
use Jenssegers\Agent\Agent;

class LoggingV
{
    /**
    * @var user 用户模型
    */
    private $user;
    /**
     * @var  action 用户动作
     */
    private $action;
    /**
     * @var content 日志内容
     */
    private $content;

    public function __construct($action, $content)
    {
        $this->action = $action;
        $this->level = content;

    }
    public static function info($action, $content)
    {
        $agent = new Agent();
        $user = fadmin_auth()->user();
        $ip = \Request::getClientIp();
        $log_info = [
            'user_name' => $user->name,
            'action' => $action,
            'ip' => $ip ,
            'level' => 'info',
            'action_time' => Carbon::createFromTimestamp(time())->toDateTimeString(),
            'content' => $content
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
            $log_info['device'] = $agent->robot();     //机器人名称
        } else {
            // 桌面设备
            $log_info['device_type'] = 'desktop';
        }
        $log_info['created_at'] = Carbon::createFromTimestamp(time())->toDateTimeString();

        DB::table('loggings')->insert($log_info);

    }
    public static function warning($action, $content)
    {
        $agent = new Agent();
        $user = fadmin_auth()->user();
        $ip = \Request::getClientIp();
        $log_info = [
            'user_name' => $user->name,
            'action' => $action,
            'ip' => $ip ,
            'level' => 'warning',
            'action_time' => Carbon::createFromTimestamp(time())->toDateTimeString(),
            'content' => $content
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
            $log_info['device'] = $agent->robot();     //机器人名称
        } else {
            // 桌面设备
            $log_info['device_type'] = 'desktop';
        }
        $log_info['created_at'] = Carbon::createFromTimestamp(time())->toDateTimeString();

        DB::table('loggings')->insert($log_info);
    }
    public static function error($action, $content)
    {
        $agent = new Agent();
        $user = fadmin_auth()->user();
        $ip = \Request::getClientIp();
        $log_info = [
            'user_name' => $user->name,
            'action' => $action,
            'ip' => $ip ,
            'level' => 'error',
            'action_time' => Carbon::createFromTimestamp(time())->toDateTimeString(),
            'content' => $content
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
            $log_info['device'] = $agent->robot();     //机器人名称
        } else {
            // 桌面设备
            $log_info['device_type'] = 'desktop';
        }
        $log_info['created_at'] = Carbon::createFromTimestamp(time())->toDateTimeString();

        DB::table('loggings')->insert($log_info);
    }
    public static function fatal($action, $content)
    {
        $agent = new Agent();
        $user = fadmin_auth()->user();
        $ip = \Request::getClientIp();
        $log_info = [
            'user_name' => $user->name,
            'action' => $action,
            'ip' => $ip ,
            'level' => 'fatal',
            'action_time' => Carbon::createFromTimestamp(time())->toDateTimeString(),
            'content' => $content
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
            $log_info['device'] = $agent->robot();     //机器人名称
        } else {
            // 桌面设备
            $log_info['device_type'] = 'desktop';
        }
        $log_info['created_at'] = Carbon::createFromTimestamp(time())->toDateTimeString();

        DB::table('loggings')->insert($log_info);
    }
}
