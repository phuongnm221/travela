<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class TestMail extends Command
{
    protected $signature = 'test:mail';
    protected $description = 'Test email sending';

    public function handle()
    {
        $user = (object) [
            'email' => 'minhphuong.20160@gmail.com',
            'username' => 'testuser',
            'fullName' => 'Test User'
        ];

        try {
            Mail::send('clients.emails.account-locked', [
                'user' => $user,
                'minutes' => 1,
                'level' => 1,
                'reset_token' => 'testabc123test',
                'expires' => Carbon::now()->addMinutes(30),
                'title' => 'Tài khoản bị khóa'
            ], function($message) use ($user) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($user->email)->subject('Test Lock Email');
            });

            $this->info('✅ Email sent successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            \Log::error('Test mail error: ' . $e->getMessage());
        }
    }
}
