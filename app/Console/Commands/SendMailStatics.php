<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Mail;
use App\Models\Monitor;

class SendMailStatics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ml:send-mail-statics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每周发送汇总数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("开始发送邮件...");
        $users = User::all();
        $odata = Monitor::where("file_type", "tanzhen")->orderBy('update_date', 'desc')
                        ->take(7)
                        ->get();
        $ldata = Monitor::where("file_type", "label")->orderBy('update_date', 'desc')
                        ->take(7)
                        ->get();
        $weeklyOdata = 0;
        $weeklyLdata = 0;

        foreach ($odata as $data)
        {
            $weeklyOdata += $data->space_size;
        }
        foreach ($ldata as $data)
        {
            $weeklyLdata += $data->space_size;
        }

        $to = [];
        $cc = [];

        foreach ($users as $user)
        {
            if ($user->id == 1)
            {
                array_push($to, $user->email);
            }
            else
            {
                array_push($cc, $user->email);
            }
        }

        $message = '互联网运营平台本周数据更新情况如下:';
        $subject = '互联网运营平台数据更新';
        Mail::send(
            'fadmin.monitor.statics',
            ['content' => $message, 'user' => "all", 'odata' => $odata,'ldata' => $ldata, 'sumOdata' => round($weeklyOdata/1024,2), 'sumLdata'=> round($weeklyLdata/1024,2)],
            function ($message) use($to, $cc, $subject) {
                $message->to($to)->cc($cc)->subject($subject);
            }
        );

        $this->info("邮件发送完毕。");
    }
}
