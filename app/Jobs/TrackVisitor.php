<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TrackVisitor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ipAddress;
    protected $userAgent;

    public function __construct($ipAddress, $userAgent)
    {
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    public function handle()
    {
        DB::table('visitor')->insert([
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
            'visit_datetime' => now()
        ]);
    }
}
