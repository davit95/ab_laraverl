<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Helpers\UsStates;
use App\Console\Helpers\Countries;
use App\Console\Helpers\CountryCities;
use App;
use DB;
use App\Models\ApiCredential;

class GenerateApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "api-key {full_access=false}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating api key';

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
    public function fire(ApiCredential $apiCred)
    {   
        $this->info('Generating new API key and secret');
        $this->info('');
        $api_key = str_random(20);
        $api_secret = str_random(20);        
        $full_access= $this->argument('full_access');
        $apiCred->create([
            'api_key'    => $api_key,
            'api_secret' => $api_secret,
            'full_access' => $full_access
            // 'origin'     => $ip
        ]);
        // $this->info('New API key and secret for '.$ip);
        $this->info('New API key and secret');
        $this->info($api_key);
        $this->info($api_secret);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [            
            ['full_access', InputArgument::REQUIRED, 'Full Access'],
        ];
    }
}
