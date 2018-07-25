<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Monitor;
// use App\Notifications\MonitorFulled;
use Mail;

class SendMailWhenFulled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ml:send-mail-when-full';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '当磁盘满时发送邮件';

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

        $data = Monitor::where("file_type", "O")->orderBy('update_date', 'desc')
                        ->take(1)
                        ->get();

        if ($data[0]->filesystem_use_percentage > 60)
        {
            $message = '互联网运营平台17号机器本地磁盘使用量已经超过60%，请及时处理！';
            $subject = '磁盘使用量超60%';
            Mail::send(
                'fadmin.monitor.mail',
                ['content' => $message, 'user' => "all", 'data' =>$data[0]],
                function ($message) use($to, $cc, $subject) {
                    $message->to($to)->cc($cc)->subject($subject);
                }
            );
        }
        $this->info("邮件发送完毕。");
    }
}
