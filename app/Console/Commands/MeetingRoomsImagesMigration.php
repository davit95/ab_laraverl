<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Helpers\UsStates;
use App\Console\Helpers\Countries;
use App\Console\Helpers\CountryCities;
use App;
use DB;

class MeetingRoomsImagesMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "mrimages:migrate";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate meeting rooms images to database.';

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
    public function fire()
    {
        $counter = 0;
        $errors_count = 0;
        $path = realpath('/home/raphael/storage/Pictures');
        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        $files = [];
        $ids = [];
        $data = [];
        foreach($objects as $name => $object)
        {
            $match = preg_match("/^.*\.(jpg|jpeg|png|gif)$/i", $name);
            if($match)
            {
                $files[] = ['full_path' => $name, 'base_name' => basename($name)];
            }
        }
        foreach($files as $file_name)
        {
            $file = $file_name['base_name'];
            $first_underscore = strpos($file, "_");
            $center_id = substr($file, 0, $first_underscore);
            $cuted_file = substr($file, $first_underscore + 1);
            $second_underscore = strpos($cuted_file, "_");
            $mr_id = substr($cuted_file, 0, $second_underscore);
            if($mr_id && $center_id)
            {
                $data[] = ['center_id' => $center_id, 'meeting_room_id' => $mr_id];
            }
            else
            {
                $errors_count++;
                //$this->error($file_name['full_path']);
            }
        }
        $this->info($errors_count . " invalid file names.");
        var_dump($data);
        //DB::table

    }
}
