<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Config;
use App\Models\Center;

class VoImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voimages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move images from abcn.com';

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
        $this->info("\n Moving images from abcn.com");
        $adapter = new Local(public_path().'/testImages',null, null,[
                'file' => [
                    'public' => 0777,
                    'private' => 0700,
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0700,
                ]
            ]);

        $centers = Center::all();
        foreach ($centers as $center) {
            $this->info("\n".$center->name.' images');               
            $bar = $this->output->createProgressBar(count($center->vo_photos));            
            foreach( $center->vo_photos as $photo ){
                $contents = file_get_contents('http://www.abcn.com/images/photos/'.$photo->path);
                $adapter->write(''.$photo->path, $contents, $config);
                $bar->advance();
            }       
            $bar->finish();
            $this->info(' ✔');
        }   
    }
}
