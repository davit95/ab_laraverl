<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Config;
use App\User;

class OwnersSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'owners:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get owners from old db';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user) {       
        parent::__construct();
        $this->user = $user;
    }
    
    public function fire(Config $config) {
        $this->info("\n Get owners from old db");
        $this->user->create([
            'email' => 'jreinstein@pbcenters.com',
            'username' => 'PREMIERBC',
            'password' => bcrypt('PREMIERBC'),
            'role_id' => 5
        ]);
    }
}
