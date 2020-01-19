<?php

namespace App\Console\Commands;

use App\Models\AdminUser;
use Illuminate\Console\Command;

class FmockInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fmock:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'some init for FMock';

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
     * 初始化项目
     *
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->getAdminUserCount()) {
            $this->info('===== FMock Install Start =====');
            $this->call('key:generate');
            $this->call('storage:link');
            $this->call('migrate');
            $this->call('passport:install');
            $this->call('db:seed');
            $this->info('===== FMock Install End =====');
        } else {
            $this->error('===== ERROR: You had installed! =====');
        }
    }

    /**
     * author shyZhen <huaixiu.zhen@gmail.com>
     * https://www.litblc.com
     *
     * @return int
     */
    private function getAdminUserCount()
    {
        return AdminUser::all()->count();
    }
}
