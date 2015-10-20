<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Helpers\UsStates;
use App\Console\Helpers\Countries;
use App\Console\Helpers\CountryCities;
use App;
use DB;

class DataMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "data:migrate {--host=localhost} {--database=abcn} {--username=homestead} {--password=secret}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from old database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UsStates $usStates, Countries $_countries, CountryCities $countryCities)
    {
        $this->usStates = $usStates;
        $this->_countries = $_countries;
        $this->countryCities = $countryCities;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->regions();
        $this->us_states();
        $this->countries();
        $this->cities();
        $this->centers();
        $this->virtual_offices_seos();
        $this->meeting_rooms_seos();
        $this->detect_active_cities();
        $this->centers_coordinates();
        $this->centers_emails();
        $this->centers_photos();
        $this->centers_filters();
        $this->centers_prices();
        $this->products();
        $this->customers_files();
        $this->owners();
        $this->customers();
        $this->meeting_rooms();
        $this->meeting_rooms_options();
        $this->tel_countries();
        $this->tel_prefixes();
    }

    private function centers()
    {
        $this->info("\n  migrating centers table");
        $this->make_new_connection();
        $collection = DB::table('Center')->get();
        DB::setDefaultConnection('mysql');
        $unknown_cities_count = 0;
        $unknown_countries_count = 0;
        $unknown_states_count = 0;
        $bar = $this->output->createProgressBar(count($collection));
        foreach($collection as $key => $value)
        {
            $city = DB::table('cities')->where('name', $value->City)->first();
            $country = DB::table('countries')->where('code', $value->Country)->first();
            $state = DB::table('us_states')->where('code', $value->State)->first();
            if(null != $city)
            {
                $city_id = $city->id;
            }
            else
            {
                $unknown_cities_count++;
                $city_id = null;
            }
            if(null != $country)
            {
                $country_id = $country->id;
            }
            else
            {
                $unknown_countries_count++;
                $country_id = null;;
            }
            if(null != $state)
            {
                $state_id = $state->id;
            }
            else
            {
                $unknown_states_count++;
                $state_id = null;
            }
            $new_collection[] =
            [
                'id'                => $value->CenterID,
                'slug'              => str_slug(preg_replace('/^[^a-zA-Z]*/', '', $value->Address1)),
                'owner_id'          => $value->OwnerID,
                'city_name'         => $value->City,
                'city_id'           => $city_id,
                'country'           => $value->Country,
                'country_id'        => $country_id,
                'us_state'          => $value->State,
                'us_state_id'       => $state_id,
                'region_id'         => '-------------',
                'company_name'      => $value->CompanyName,
                'building_name'     => $value->BuildingName,
                'address1'          => $value->Address1,
                'address2'          => $value->Address2,
                'postal_code'       => $value->PostalCode,
                'summary'           => $value->Summary,
                'location'          => $value->Location,
                'amenities'         => $value->Amenities,
                'review_date'       => $value->ReviewDate,
                'review_comments'   => $value->ReviewComments,
                'active_flag'       => $value->ActiveFlag,
                'notes'             => $value->Notes,
                'virtual_tour_url'  => $value->VirtualTourURL,
                'map_url'           => $value->MapURL,
                'status_changed_at' => $value->StatusChange,
                'updated_at'        => $value->CenterChange
            ];
            $bar->advance();
        }
        DB::table('centers')->truncate();
        DB::table('centers')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');

    }

    private function centers_coordinates()
    {
        $this->info("\n migrating centers_coordnates table");
        $this->make_new_connection();
        $collection = DB::table('Center_Coords')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach($collection as $key => $value)
        {
            $new_collection[] =
            [
                'id'        => $value->Object_ID,
                'center_id' => $value->Center_ID,
                'lat'       => $value->Latitude,
                'lng'       => $value->Longitude
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('centers_coordinates')->truncate();
        DB::table('centers_coordinates')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function centers_emails()
    {
        $this->info("\n migrating centers_emails table");
        $this->make_new_connection();
        $collection = DB::table('Center_Emails')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach($collection as $key => $value)
        {
            $new_collection[] =
            [
                'center_id' => $value->Center_ID,
                'email'     => $value->Email
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('centers_emails')->truncate();
        DB::table('centers_emails')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function centers_photos()
    {
        $this->info("\n migrating centers_photos table");
        $this->make_new_connection();
        $collection = DB::table('Center')->get();
        $bar = $this->output->createProgressBar(count($collection));
        $counter = 0;
        foreach($collection as $key => $value)
        {
            $curr_photos[] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo1)->first();
            $curr_photos[] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo2)->first();
            $curr_photos[] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo3)->first();
            $curr_photos[] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo4)->first();
            $curr_photos[] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo5)->first();
            $curr_photos[] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo6)->first();
            foreach ($curr_photos as $k => $v)
            {
                if(null != $v)
                {
                    $new_collection[] =
                    [
                        'center_id'   => $value->CenterID,
                        'path'        => $v->Image_Name,
                        'description' => $v->Description,
                        'alt'         => $v->Alt,
                        'caption'     => $v->Caption
                    ];
                }
                $bar->advance();

            }
            $curr_photos = [];
        }
        DB::setDefaultConnection('mysql');
        DB::table('centers_photos')->truncate();
        DB::table('centers_photos')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function virtual_offices_seos()
    {
        $this->info("\n migrating virtual_offices_seos table");
        $this->make_new_connection();
        $collection = DB::table('Center_SEO')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach($collection as $key => $value)
        {
            $new_collection[] =
            [
                'center_id'        => $value->Center_ID,
                'sentence1'        => $value->Sentence_1,
                'sentence2'        => $value->Sentence_2,
                'sentence3'        => $value->Sentence_3,
                'avo_description'  => $value->AVO_Description,
                'meta_title'       => $value->Meta_Title,
                'meta_description' => $value->Meta_Description,
                'meta_keywords'    => $value->Meta_Keywords,
                'h1'               => $value->H1,
                'h2'               => $value->H2,
                'h3'               => $value->H3,
                'seo_footer'       => $value->SEO_Footer,
                'abcn_description' => $value->ABCN_Description,
                'abcn_title'       => $value->ABCN_Title,
                'subhead'          => $value->Subhead
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('virtual_offices_seos')->truncate();
        DB::table('virtual_offices_seos')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function meeting_rooms_seos()
    {
        $this->info("\n migrating meeting_rooms_seos table");
        $this->make_new_connection();
        $collection = DB::table('Center_SEO_MR')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach($collection as $key => $value)
        {
            $new_collection[] =
            [
                'center_id'        => $value->Center_ID,
                'sentence1'        => $value->Sentence_1,
                'sentence2'        => $value->Sentence_2,
                'sentence3'        => $value->Sentence_3,
                'avo_description'  => $value->AVO_Description,
                'meta_title'       => $value->Meta_Title,
                'meta_description' => $value->Meta_Description,
                'meta_keywords'    => $value->Meta_Keywords,
                'h1'               => $value->H1,
                'h2'               => $value->H2,
                'h3'               => $value->H3,
                'seo_footer'       => $value->SEO_Footer,
                'abcn_description' => $value->ABCN_Description,
                'abcn_title'       => $value->ABCN_Title,
                'subhead'          => $value->Subhead
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('meeting_rooms_seos')->truncate();
        DB::table('meeting_rooms_seos')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function centers_filters()
    {
        $this->info("\n migrating centers_filters table");
        DB::setDefaultConnection('mysql');
        $centers = DB::table('centers')->get();
        $bar = $this->output->createProgressBar(count($centers));
        $this->make_new_connection();
        foreach($centers as $center)
        {

            if(null != $filter = DB::table('Center_Filter')->where('Center_ID', $center->id)->first())
            {
                $new_collection[] =
                [
                    'center_id'      => $filter->Center_ID,
                    'virtual_office' => $filter->Approval_1 == 'Approved' ? true : false,
                    'office'         => $filter->Approval_2 == 'Approved' ? true : false,
                    'meeting_room'   => $filter->Approval_3 == 'Approved' ? true : false,
                ];
            }
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('centers_filters')->truncate();
        DB::table('centers_filters')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function centers_prices()
    {
        $this->info("\n migrating centers_filters table");
        $this->make_new_connection();
        $prices = DB::table('Center_Package_Pricing')->get();
        $bar = $this->output->createProgressBar(count($prices));
        foreach ($prices as $price)
        {
            $new_collection[] =
            [
                'center_id'  => $price->Center_ID,
                'package_id' => $price->Package_ID,
                'price'      => $price->Price,
                'with_live_receptionist_pack_price' => $price->Price+85,
                'with_live_receptionist_full_price' => $price->Price+95,
                'updated_at' => date('Y-m-d H:i:s', $price->Modify_Date)
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('centers_prices')->truncate();
        DB::table('centers_prices')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    public function products()
    {
        $this->info("\n migrating products table");
        $this->make_new_connection();
        $products = DB::table('Products')->get();
        $bar = $this->output->createProgressBar(count($products));
        foreach ($products as $product)
        {
            $new_collection[] =
            [
                'id'          => $product->Object_ID,
                'part_number' => $product->Part_Number,
                'name'        => $product->Name,
                'price'       => $product->Price,
                'created_at'  => date('Y-m-d H:i:s', $product->Date_Added),
                'updated_at'  => date('Y-m-d H:i:s', $product->Date_Added)
            ];
            $bar->advance();
        }

        DB::setDefaultConnection('mysql');
        DB::table('products')->truncate();
        DB::table('products')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function cities()
    {
        $this->info("\n migrating cities table");
        $count = 0;
        $states = $this->usStates->getStates();
        $other_cities = $this->countryCities->getCities();

        $bar_other_ciites = $this->output->createProgressBar(count($other_cities));
        DB::setDefaultConnection('mysql');
        DB::table('cities')->truncate();
        $us = DB::table('countries')->where('code', 'US')->first();
        $us_id = $us->id;
        $us_state_ids = DB::table('us_states')->lists('id','name');
        $us_state_codes = DB::table('us_states')->lists('code','name');
        $key = 0;

        foreach( $states as $st_name => $state)
        {
            foreach ($state as $city)
            {
                if ($count%250 == 0) {
                    $key++;
                }
                $cities[$key][] =
                [
                    'name'          => $city,
                    'us_state'      => $st_name,
                    'slug'          => str_slug($city),
                    'us_state_id'   => $us_state_ids["$st_name"],
                    'us_state_code' => $us_state_codes["$st_name"],
                    'country_code'  => $us->code,
                    'country_id'    => $us_id
                ];
                $count++;
            }

        }
        $bar_states = $this->output->createProgressBar(count($cities));
        foreach ($cities as $key => $city) {
            DB::table('cities')->insert($city);
            $bar_states->advance();
        }
        $bar_states->finish();
        $this->info(" ✔\n");


        foreach ($other_cities as $country => $cities)
        {
            $country_obj = DB::table('countries')->where('name', $country)->first();
            if(null != $country_obj)
            {
                foreach($cities as $city)
                {
                    $arr =
                    [
                        'name'          => $city,
                        'us_state'      => null,
                        'slug'          => str_slug($city),
                        'us_state_id'   => null,
                        'us_state_code' => null,
                        'country_code'  => $country_obj->code,
                        'country_id'    => $country_obj->id
                    ];
                    DB::table('cities')->insert($arr);
                }
            }
            else
            {

            }
            $bar_other_ciites->advance();
        }
        $bar_other_ciites->finish();
        $this->info(" ✔");
    }

    private function countries()
    {
        $this->info("\n migrating countries table");
        $all_countries = $this->_countries->getCountries();
        $bar = $this->output->createProgressBar(count($all_countries));
        DB::setDefaultConnection('mysql');
        foreach ($all_countries as $country)
        {
            $new_collection[] =
            [
                'name'           => $country['name'],
                'code'           => $country['code'],
                'slug'           => str_slug($country['name'])
            ];
            $bar->advance();
        }

        DB::table('countries')->truncate();
        DB::table('countries')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');

    }

    private function customers_files()
    {
        $this->info("\n migrating customers_files table");
        $this->make_new_connection();
        $collection = DB::table('Customers_Files')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach ($collection as $key => $value)
        {
            $new_collection[] =
            [
                'id'             => $value->File_ID,
                'customer_id'    => $value->Customer_ID,
                'file_type'      => $value->File_Type,
                'uploaded_by'    => $value->Uploaded_By,
                'path'           => $value->File_Name,
                'file_category'  => $value->File_Category,
                'created_at'     => date('Y-m-d H:i:s', $value->Upload_Time)
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('customers_files')->truncate();
        DB::table('customers_files')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');

    }

    private function owners()
    {
        $this->info("\n migrating owners table");
        $this->make_new_connection();
        $collection = DB::table('Center_Owner')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach ($collection as $key => $value)
        {
            $new_collection[] =
            [
                'id'           => $value->OwnerID,
                'name'         => $value->OwnerName,
                'phone'        => $value->Phone,
                'fax'          => $value->Fax,
                'url'          => $value->URL,
                'email'        => $value->Email,
                'address1'     => $value->Address1,
                'address2'     => $value->Address2,
                'city_id'      => '------------',
                'region_id'    => '------------',
                'us_state_id'  => '------------',
                'country_id'   => '------------',
                'postal_code'  => $value->PostalCode,
                'notes'        => $value->Notes,
                'company_name' => $value->CompanyName,
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('owners')->truncate();
        DB::table('owners')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');

    }

    private function regions()
    {
        $this->info("\n migrating regions table");
        $this->make_new_connection();
        $collection = DB::table('Region')->get();
        $bar = $this->output->createProgressBar(count($collection));
        foreach ($collection as $key => $value)
        {
            $new_collection[] =
            [
                'name'         => $value->Region,
                'email'        => $value->Email,
                'contact_info' => $value->ContactInfo
            ];
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('regions')->truncate();
        DB::table('regions')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');

    }

    private function us_states()
    {
        $this->info("\n migrating us_states table");
        $new_collection =
        array(
            array('name' => 'Alabama', 'code' => 'AL'),
            array('name' => 'Alaska', 'code' => 'AK'),
            array('name' => 'Arizona', 'code' => 'AZ'),
            array('name' => 'Arkansas', 'code' => 'AR'),
            array('name' => 'California', 'code' => 'CA'),
            array('name' => 'Colorado', 'code' => 'CO'),
            array('name' => 'Connecticut', 'code' => 'CT'),
            array('name' => 'Delaware', 'code' => 'DE'),
            array('name' => 'District of Columbia', 'code' => 'DC'),
            array('name' => 'Florida', 'code' => 'FL'),
            array('name' => 'Georgia', 'code' => 'GA'),
            array('name' => 'Hawaii', 'code' => 'HI'),
            array('name' => 'Idaho', 'code' => 'ID'),
            array('name' => 'Illinois', 'code' => 'IL'),
            array('name' => 'Indiana', 'code' => 'IN'),
            array('name' => 'Iowa', 'code' => 'IA'),
            array('name' => 'Kansas', 'code' => 'KS'),
            array('name' => 'Kentucky', 'code' => 'KY'),
            array('name' => 'Louisiana', 'code' => 'LA'),
            array('name' => 'Maine', 'code' => 'ME'),
            array('name' => 'Maryland', 'code' => 'MD'),
            array('name' => 'Massachusetts', 'code' => 'MA'),
            array('name' => 'Michigan', 'code' => 'MI'),
            array('name' => 'Minnesota', 'code' => 'MN'),
            array('name' => 'Mississippi', 'code' => 'MS'),
            array('name' => 'Missouri', 'code' => 'MO'),
            array('name' => 'Montana', 'code' => 'MT'),
            array('name' => 'Nebraska', 'code' => 'NE'),
            array('name' => 'Nevada', 'code' => 'NV'),
            array('name' => 'New Hampshire', 'code' => 'NH'),
            array('name' => 'New Jersey', 'code' => 'NJ'),
            array('name' => 'New Mexico', 'code' => 'NM'),
            array('name' => 'New York', 'code' => 'NY'),
            array('name' => 'North Carolina', 'code' => 'NC'),
            array('name' => 'North Dakota', 'code' => 'ND'),
            array('name' => 'Ohio', 'code' => 'OH'),
            array('name' => 'Oklahoma', 'code' => 'OK'),
            array('name' => 'Oregon', 'code' => 'OR'),
            array('name' => 'Pennsylvania', 'code' => 'PA'),
            array('name' => 'Rhode Island', 'code' => 'RI'),
            array('name' => 'South Carolina', 'code' => 'SC'),
            array('name' => 'South Dakota', 'code' => 'SD'),
            array('name' => 'Tennessee', 'code' => 'TN'),
            array('name' => 'Texas', 'code' => 'TX'),
            array('name' => 'Utah', 'code' => 'UT'),
            array('name' => 'Vermont', 'code' => 'VT'),
            array('name' => 'Virginia', 'code' => 'VA'),
            array('name' => 'Washington', 'code' => 'WA'),
            array('name' => 'West Virginia', 'code' => 'WV'),
            array('name' => 'Wisconsin', 'code' => 'WI'),
            array('name' => 'Wyoming', 'code' => 'WY')
        );
        $bar = $this->output->createProgressBar(count($new_collection));
        foreach ($new_collection as $key => $value)
        {
            $new_collection[$key]['slug'] = str_slug($value['name']);
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        DB::table('us_states')->truncate();
        DB::table('us_states')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');

    }

    private function customers()
    {
        $this->info("\n migrating customers table");
        $this->make_new_connection();
        $collection = DB::table('Customers')->get();
        $bar = $this->output->createProgressBar(count($collection));
        $max = DB::table('Customers')->count();

        $passwords = DB::table('Customer_Hashes')->lists('Password', 'Customer_ID');
        DB::setDefaultConnection('mysql');
        DB::table('customers')->truncate();


        $counter = 0;
        $int_perc = 0;
        foreach ($collection as $key => $value)
        {


            $new_collection =
            [
                'id'              => $value->Customer_ID,
                'first_name'      => $value->First_Name,
                'last_name'       => $value->Last_Name,
                'company_name'    => $value->Company_Name,
                'email'           => $value->Email,
                'username'        => $value->Username,
                'phone'           => $value->Phone1,
                'passwrod_hint'   => $value->Password_Hint,
                'address1'        => $value->Address1,
                'address2'        => $value->Address2,
                'city_id'         => '---------------',
                'us_state_id'     => '---------------',
                'postal_code'     => $value->Postal_Code,
                'country_id'      => '---------------',
                'password'        => isset($passwords[$value->Customer_ID]) ? $passwords[$value->Customer_ID] : null,
                'cc_name'         => $value->CC_Name,
                'cc_number'       => $value->CC_Number,
                'cc_year'         => $value->CC_Year,
                'cc_month'        => $value->CC_Month,
                'cvv2'            => $value->CVV2,
                'status'          => $value->Status,
                'fax'             => $value->Fax1,
                'hint_answer'     => $value->Hint_Answer,
                'dv_user_key'     => $value->DV_User_Key,
                'dv_phone_number' => $value->DV_Phone_Number,
                'created_at'      => date('Y-m-d H:i:s', $value->Add_Date)
            ];
            /*$counter++;
            $perc = ($counter / $max) * 100;
            if((int)$perc > $int_perc)
            {
                $int_perc = (int)$perc;
                $this->info($int_perc."%");
            }*/

            DB::table('customers')->insert($new_collection);
            $bar->advance();
        }
        $bar->finish();
        $this->info(' ✔');
    }

    private function detect_active_cities()
    {
        $this->info("\n detecting active cities in system");
        DB::setDefaultConnection('mysql');
        $cities = DB::table('cities')->get();
        $count = 0;
        $key = 0;
        $bar = $this->output->createProgressBar(count($cities));
        foreach ($cities as $key => $value)
        {
            if(DB::table('centers')->where('city_id', $value->id)->where('active_flag', 'Y')->first() != null)
            {
                DB::table('cities')->where('id', $value->id)->update(['active' => 1]);
            }
            else
            {
            }
            $count++;
            $bar->advance();
        }
        $bar->finish();
        $this->info('✔');
    }


    private function meeting_rooms()
    {
        $this->info("\n migrating meeting_rooms table");
        $this->make_new_connection();
        $meeting_rooms = DB::table('Meeting_Rooms')->get();
        $bar = $this->output->createProgressBar(count($meeting_rooms));
        foreach ($meeting_rooms as $room)
        {
            $new_collection[] =
            [
                'id'            => $room->Meeting_Room_ID,
                'center_id'     => $room->Center_ID,
                'name'          => $room->Name,
                'capacity'      => $room->Capacity,
                'hourly_rate'   => $room->Hourly_Rate,
                'half_day_rate' => $room->Half_Day_Rate,
                'full_day_rate' => $room->Full_Day_Rate,
                'min_hours_req' => $room->Min_Hours_Req,
                'floor'         => $room->Floor
            ];
            $bar->advance();
        }


        DB::setDefaultConnection('mysql');
        DB::table('meeting_rooms')->truncate();
        DB::table('meeting_rooms')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function meeting_rooms_options()
    {
        $this->info("\n migrating meeting_rooms_options table");
        $this->make_new_connection();
        $meeting_rooms_options = DB::table('Meeting_Room_Options')->get();
        $bar = $this->output->createProgressBar(count($meeting_rooms_options));
        foreach ($meeting_rooms_options as $option)
        {
            $new_collection[] =
            [
                'meeting_room_id'             =>  $option->Meeting_Room_ID,
                'room_description'            =>  $option->Room_Description,
                'parking_rate'                =>  $option->Parking_Rate,
                'parking_description'         =>  $option->Parking_Description,
                'network_rate'                =>  $option->Network_Rate,
                'wireless_rate'               =>  $option->Wireless_Rate,
                'phone_rate'                  =>  $option->Phone_Rate,
                'admin_services_rate'         =>  $option->Admin_Services_Rate,
                'whiteboard_rate'             =>  $option->Whiteboard_Rate,
                'tvdvdplayer_rate'            =>  $option->Tvdvdplayer_Rate,
                'projector_rate'              =>  $option->Projector_Rate,
                'videoconferencing_rate'      =>  $option->Videoconferencing_Rate,
                'video_equipment'             =>  $option->Video_Equipment,
                'bridge_connection_available' =>  $option->Bridge_Connection_Available,
                'catering'                    =>  $option->Catering,
                'credit_cards'                =>  $option->Credit_Cards
            ];
            $bar->advance();
        }


        DB::setDefaultConnection('mysql');
        DB::table('meeting_rooms_options')->truncate();
        DB::table('meeting_rooms_options')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function tel_countries()
    {
        $this->info("\n migrating tel_countries table");
        $this->make_new_connection();
        $tel_countries = DB::table('tel_Countries')->get();
        $bar = $this->output->createProgressBar(count($tel_countries));
        foreach ($tel_countries as $country)
        {
            $new_collection[] =
            [
                'country_code' => $country->Country_Code,
                'full_name'    => $country->Full_Name,
                'abbrv'        => $country->Abbrv,
                'logtime'      => $country->Logtime
            ];
            $bar->advance();
        }


        DB::setDefaultConnection('mysql');
        DB::table('tel_countries')->truncate();
        DB::table('tel_countries')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function tel_prefixes()
    {
        $this->info("\n migrating tel_prefixes table");
        $this->make_new_connection();
        $tel_prefixes = DB::table('tel_Prefixes')->get();
        $bar = $this->output->createProgressBar(count($tel_prefixes));
        foreach ($tel_prefixes as $prefix)
        {
            $new_collection[] =
            [
                'country_code' => $prefix->Country_Code,
                'prefix'       => $prefix->Prefix,
                'logtime'      => $prefix->Logtime,
            ];
            $bar->advance();
        }


        DB::setDefaultConnection('mysql');
        DB::table('tel_prefixes')->truncate();
        DB::table('tel_prefixes')->insert($new_collection);
        $bar->finish();
        $this->info(' ✔');
    }

    private function make_new_connection()
    {
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
