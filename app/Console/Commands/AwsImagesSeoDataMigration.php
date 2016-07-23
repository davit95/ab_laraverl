<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPExcel_IOFactory;
use DB;

class AwsImagesSeoDataMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'awsimages:migrate';

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
        $this->aws_images_seo_data();
    }

    private function aws_images_seo_data() {
        $this->info("\n migrating aws images seo data");
        //$this->make_new_connection();
        $i = 1;
        require_once(app_path().'/Classes/PHPExcel.php');
        $excelFile = public_path()."/aws_images_seo_data/aws-image-seo-content.xlsx";

        $pathInfo = pathinfo($excelFile);
        $type = $pathInfo['extension'] == 'xlsx' ? 'Excel2007' : 'Excel5';

        $objReader = PHPExcel_IOFactory::createReader($type);
        $objPHPExcel = $objReader->load($excelFile);

        DB::setDefaultConnection('mysql');
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            foreach ($worksheet->toArray() as $key => $value) {
                $new_collection[] =
                [
                    'center_id' => round($value[0]),
                    'image_name'       => $value[1],
                    'description'       => $value[2],
                    'alt'       => $value[3],
                    'caption'       => $value[4],
                ];
            }
        }
        $bar  = $this->output->createProgressBar(count($new_collection));
        foreach ($new_collection as $key => $value) {
            $bar->advance();
        }
        unset($new_collection[0]);

        
        DB::table('aws_image_seo')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }
}
