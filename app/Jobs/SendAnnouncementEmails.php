<?php

namespace App\Jobs;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class SendAnnouncementEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $announcement;

    /**
     * Create a new job instance.
     *
     * @param Announcement $announcement
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 獲取所有用戶
        $users = User::all();

        // 針對每個用戶發送電子郵件
        foreach ($users as $user) {
            Mail::send('backend.emails.announcement', ['announcement' => $this->announcement], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('TestShop公告');
            });
        }
    }
}

