<?php

namespace Pyaesone17\Lapse\Commands;

use Illuminate\Console\Command;
use DB;

class ClearLapse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:lapse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the errors of the lapse';

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
        DB::table('notifications')
        ->where('type','=','Pyaesone17\Lapse\Notifications\RemindExceptionNotification')
        ->delete();
    }
}
