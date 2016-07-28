<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPExcel_IOFactory;
use DB;

class LocationSocialMetaDataMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locationsocialdata:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function fire() {
        $this->location_social_media_data();
    }

    private function location_social_media_data() {
        $this->info("\n migrating location social media data");
        //$this->make_new_connection();
        $i = 1;
        require_once(app_path().'/Classes/PHPExcel.php');
        $excelFile = public_path()."/xlsx/location_social_media_data/location-social-media-data.xlsx";

        $pathInfo = pathinfo($excelFile);
        $type = $pathInfo['extension'] == 'xlsx' ? 'Excel2007' : 'Excel5';
        $objReader = PHPExcel_IOFactory::createReader($type);
        $objPHPExcel = $objReader->load($excelFile);

        DB::setDefaultConnection('mysql');
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            //dd($worksheet->toArray()[6]);
            foreach ($worksheet->toArray() as $key => $value) {
                $new_collection[] =
                [
                    'center_id'     => round($value[0]),
                    'youtube_url'   => isset($value[1]) ? $value[1] : null,
                    'location_url'  => isset($value[2]) ? $value[2] : null,
                    'facebook_url'  => isset($value[3]) ? $value[3] : null,
                    'twitter_url'   => isset($value[4]) ? $value[4] : null,
                ];
            }
        }
        //dd('as');
        $bar  = $this->output->createProgressBar(count($new_collection));
        unset($new_collection[0]);
        foreach ($new_collection as $key => $value) {
            if($value['center_id'] == 0 || $value['center_id'] == null) {
                unset($new_collection[$key]);
            }
            $bar->advance();
        }
        
        //dd($new_collection[1]);
        DB::table('location_social_media_data')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }
}
