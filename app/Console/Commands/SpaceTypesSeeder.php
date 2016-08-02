<?php

namespace App\Console\Commands;

use App;
use Illuminate\Console\Command;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Config;
use App\Models\Center;
use DB;

class SpaceTypesSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */    
    protected $signature = "spaceTypes {--host=localhost} {--database=abcn-old} {--username=root} {--password=secret}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save center space types';

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
    public function __construct() {       
        parent::__construct();
    }
    
    public function fire(Config $config) {
        $this->info("\n Saving center space types");
        $this->make_new_connection();
        $collection = DB::table('Center_Space_Type')->get();
        DB::setDefaultConnection('mysql');
        //$center_ids = DB::table('centers')->lists('id');
        $center_old_ids = DB::table('centers')->lists('old_id');
        $center_old_id_list = DB::table('centers')->lists('old_id', 'id');
        $bar = $this->output->createProgressBar(count($collection));
        foreach ($collection as $key => $value) {
            if (in_array($value->Center_ID, $center_ids)) {
                $slug = str_replace(' ', '_', strtolower($value->Type));
                $center_id = array_search($value->Center_ID, $center_old_id_list);
                $new_collection[] =
                [
                    'id'        => $value->Object_ID,
                    'center_id' => $value->Center_ID,
                    'type'      => $value->Type,
                    'slug'      => $slug
                ];
            }
            $bar->advance();
        }
        DB::table('center_space_types')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function make_new_connection() {
        App::make('config')->set('database.connections.tmp',
            [
                'driver'    => 'mysql',
                'host'      => $this->option('host'),
                'database'  => $this->option('database'),
                'username'  => $this->option('username'),
                'password'  => $this->option('password'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
                'port'      => '3306'
            ]);
        DB::setDefaultConnection('tmp');
    }
}
