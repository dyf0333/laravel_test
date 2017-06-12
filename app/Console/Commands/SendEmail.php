<?php

namespace App\Console\Commands;

use App\DripEmailer;
use App\User;
use Illuminate\Console\Command;

/**
 * php artisan make:command SendEmail
 * 命令生成的command
 */
class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send{user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a e-mail to a user';

    protected $drip;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DripEmailer $drip)
    {
        parent::__construct();
        $this->drip = $drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->drip->send(User::find($this->argument('user')));
    }
}
