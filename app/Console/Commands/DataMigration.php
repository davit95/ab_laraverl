<?php

namespace App\Console\Commands;

use App;
use App\Console\Helpers\Countries;
use App\Console\Helpers\CountryCities;
use App\Console\Helpers\UsStates;
use App\User;
use DB;
use Illuminate\Console\Command;

class DataMigration extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = "data:migrate {--host=localhost} {--database=abcn-old} {--username=root} {--password=secret}";

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
	public function __construct(User $user, UsStates $usStates, Countries $_countries, CountryCities $countryCities) {
		$this->user      = $user;
		$this->usStates      = $usStates;
		$this->_countries    = $_countries;
		$this->countryCities = $countryCities;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {
		// $this->regions();
		// $this->us_states();
		// $this->countries();
		// $this->cities();
		// $this->users();
		// $this->users_files();
		// $this->owners();
		// $this->products();
		$this->centers();
		// $this->centers_coordinates();
		// $this->features();
		// $this->centers_local_numbers();
		// $this->centers_emails();
		// $this->centers_prices();
		// $this->centers_filters();
		// $this->meeting_rooms();
		// $this->meeting_rooms_seos();
		// $this->meeting_rooms_options();
		// $this->virtual_offices_seos();
		// $this->virtual_offices_options();
		// $this->centers_photos();
		// $this->vo_photos();
		// $this->telephony_package_includes();
		// $this->tel_countries();
		// $this->tel_prefixes();
		// $this->detect_active_cities();
		// $this->location_SEO();
	}

	private function centers() {
		$this->info("\n migrating centers table");
		$this->make_new_connection();
		$collection     = DB::table('Center')->get();
		$center_contacts = DB::table('Center_Contact')->lists('EmailFlag', 'CenterID');				
		$seo_collection = DB::table('Center_SEO')->lists('H3', 'Center_ID');	
		DB::setDefaultConnection('mysql');
		$centers_old_id_lists = DB::table('centers')->lists('old_id');
		$centers = DB::table('centers')->lists('active_flag', 'id');
		$users_ids = DB::table('users')->lists('old_owner_id', 'id');
		$unknown_cities_count    = 0;
		$unknown_countries_count = 0;
		$unknown_states_count    = 0;
		$bar                     = $this->output->createProgressBar(count($collection));
		//$count = 0;
		//dd($users_ids);
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->CenterID, $centers_old_id_lists)) {
				if(!is_null($value->State) && $value->State != '') {
					$city      = DB::table('cities')->where('name', trim($value->City))->where('country_code', $value->Country)->where('us_state_code', $value->State)->first();
				}else{
					if( preg_match('/[^a-zA-Z1-9( ,-]/', $value->City ) ){
						$value->City = utf8_decode($value->City);
					}
					$city      = DB::table('cities')->where('name', trim($value->City))->where('country_code', $value->Country)->first();
				}
				
				$country   = DB::table('countries')->where('code', $value->Country)->first();
				$state     = DB::table('us_states')->where('code', $value->State)->first();
				$owner_ids = DB::table('owners')->lists('id');
				if (null != $city) {
					$city_id = $city->id;
				} else {
					$unknown_cities_count++;
					$city_id = null;
				}
				if (null != $country) {
					$country_id = $country->id;
				} else {
					$unknown_countries_count++;
					$country_id = null;
				}
				if (null != $state) {
					$state_id = $state->id;
				} else {
					$unknown_states_count++;
					$state_id = null;
				}
				$owner_id = $value->OwnerID;
				if (!in_array($owner_id, $owner_ids)) {
					$owner_id = null;
				}
				$old_id = $value->OwnerID;
				if (!in_array($old_id, $owner_ids)) {
					$old_id = null;
				}
				// $owner_user_id = $value->OwnerID;
				// if (!in_array($owner_user_id, $owner_ids)) {
				// 	$owner_user_id = null;
				// }
				if(in_array($value->OwnerID, $users_ids)) {
					$user_id = array_search($value->OwnerID, $users_ids);
				}
				$name = '';
				if (isset($seo_collection[$value->CenterID])) {
					$title = $seo_collection[$value->CenterID];
					$parts = explode(' in ', $title);
					$name  = $parts[0];
				}
				$this->make_new_connection();			
				if(null!== $tax = DB::table('Center_Taxes')->where('Center_ID', $value->CenterID)->first()){
					$tax_name = $tax->TaxName1;
					$tax_percentage = $tax->TaxNumber1;
				}else{
					$tax_name = "";
					$tax_percentage = "";
				}
				DB::setDefaultConnection('mysql');
				$new_collection[$value->CenterID] =
				[
					'old_id'      => $value->CenterID,
					'name'        => preg_match('/[^a-zA-Z1-9( ,-]/', $name) ? utf8_decode($name) : $name,
					'slug'        => str_slug(preg_replace('/^[^a-zA-Z]*/', '', $value->Address1)),
					'owner_id'    => $owner_id,
					'owner_user_id'    => $user_id,
					'city_name'   => $value->City,
					'city_id'     => $city_id,
					'country'     => $value->Country,
					'country_id'  => $country_id,
					'us_state'    => $value->State,
					'us_state_id' => $state_id,
					//'region_id'         => '-------------',
					'company_name'      => preg_match('/[^a-zA-Z1-9( ,-]/', $value->CompanyName) ? utf8_decode($value->CompanyName) : $value->CompanyName,
					'building_name'     => preg_match('/[^a-zA-Z1-9( ,-]/', $value->BuildingName) ? utf8_decode($value->BuildingName) : $value->BuildingName,
					'address1'          => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Address1) ? utf8_decode($value->Address1) : $value->Address1,
					'address2'          => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Address2) ? utf8_decode($value->Address2) : $value->Address2,
					'postal_code'       => $value->PostalCode,
					'summary'           => $value->Summary,
					'location'          => $value->Location,
					'amenities'         => $value->Amenities,
					'review_date'       => $value->ReviewDate,
					'review_comments'   => $value->ReviewComments,
					'active_flag'       => $value->ActiveFlag,
					//'allwork_active_flag'       => $value->ActiveFlag,
					'email_flag'        => isset($center_contacts[$value->CenterID]) ? $center_contacts[$value->CenterID] : null,
					'notes'             => $value->Notes,
					'virtual_tour_url'  => $value->VirtualTourURL,
					'map_url'           => $value->MapURL,
					'status_changed_at' => $value->StatusChange,
					'updated_at'        => $value->CenterChange,
					'tax_name'          => $tax_name,
					'tax_percentage'    => $tax_percentage
				];			
				$bar->advance();
			}
		}
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('centers')->insert($new_collection);
			$new_collection = [];
		}
		foreach ($centers as $id => $flag) {
		 	DB::setDefaultConnection('mysql');
			DB::table('centers')->where('id', $id)->update(['allwork_active_flag' => $flag]);
			$bar->advance();
		} 
		$bar->finish();
		$this->info(' ✔');

	}
	private function centers_local_numbers() {
		$this->info("\n migrating centers_local_numbers table");
		$this->make_new_connection();
		$collection = DB::table('Center_Local')->get();
		DB::setDefaultConnection('mysql');
		$center_local_number_id_lists = DB::table('centers_local_number')->lists('id');
		$center_ids = DB::table('centers')->lists('old_id','id');
		$bar        = $this->output->createProgressBar(count($collection));
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->Object_ID, $center_local_number_id_lists)) {
				if(in_array($value->Center_ID, $center_ids)) {
					$center_id = array_search($value->Center_ID, $center_ids);
				}
				$new_collection[] =
				[
					'id'        => $value->Object_ID,
					'center_id' => $center_id,
					'local_number'       => $value->Local_Number,
				];
			}
			
			$bar->advance();
		}
		//DB::table('centers_coordinates')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('centers_local_number')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}
	
	private function centers_coordinates() {
		$this->info("\n migrating centers_coordnates table");
		$this->make_new_connection();
		$collection = DB::table('Center_Coords')->get();
		DB::setDefaultConnection('mysql');
		$center_coordinates_id_lists = DB::table('centers_coordinates')->lists('id');
		$center_ids = DB::table('centers')->lists('old_id', 'id');
		$bar        = $this->output->createProgressBar(count($collection));
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->Object_ID, $center_coordinates_id_lists)) {
				if(in_array($value->Center_ID, $center_ids)) {
					$center_id = array_search($value->Center_ID, $center_ids);
				}
				$new_collection[] =
				[
					'id'        => $value->Object_ID,
					'center_id' => $center_id,
					'lat'       => $value->Latitude,
					'lng'       => $value->Longitude
				];
			}
			
			$bar->advance();
		}
		//DB::table('centers_coordinates')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('centers_coordinates')->insert($new_collection);
			$new_collection = [];
		}
		$bar->finish();
		$this->info(' ✔');
	}

	private function features() {
		$this->info("\n migrating features table");
		$this->make_new_connection();
		$collection = DB::table('Features')->get();
		DB::setDefaultConnection('mysql');
		$features_name_lists = DB::table('features')->lists('name');
		$bar        = $this->output->createProgressBar(count($collection));
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->Name, $features_name_lists)) {
				$new_collection[] =
				[
					'name'       => $value->Name
				];
			}
			$bar->advance();
		}
		//DB::table('centers_coordinates')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)){
			DB::table('features')->insert($new_collection);
			$new_collection = [];
		}
		$bar->finish();
		$this->info(' ✔');
	}
	

	private function centers_emails() {
		$this->info("\n migrating centers_emails table");
		$this->make_new_connection();
		$collection = DB::table('Center_Emails')->get();
		$bar        = $this->output->createProgressBar(count($collection));
		DB::setDefaultConnection('mysql');
		$centers_emails_lists = DB::table('centers_emails')->lists('email');
		$center_ids = DB::table('centers')->lists('old_id','id');
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->Email, $centers_emails_lists)) {
				if(in_array($value->Center_ID, $center_ids)) {
					$center_id = array_search($value->Center_ID, $center_ids);
					$new_collection[] =
					[
						'center_id' => $center_id,
						'email'     => $value->Email
					];
				}
			}
			
			$bar->advance();
		}
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('centers_emails')->insert($new_collection);
			$new_collection = [];
		}
		//DB::table('centers_emails')->truncate();
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function centers_photos() {
		$this->info("\n migrating photos table");
		DB::setDefaultConnection('mysql');
		$center_photo_name_lists = DB::table('photos')->lists('path');
		$this->make_new_connection();
		$collection     = DB::table('Center')->get();
		$bar            = $this->output->createProgressBar(count($collection)*6);
		$counter        = 0;
		$new_collection = [];
		foreach ($collection as $key => $value) {
			$curr_photos['Photo1'] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo1)->first();
			$curr_photos['Photo2'] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo2)->first();
			$curr_photos['Photo3'] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo3)->first();
			$curr_photos['Photo4'] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo4)->first();
			$curr_photos['Photo5'] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo5)->first();
			$curr_photos['Photo6'] = DB::table('Image_Descriptions')->where('Image_Name', $value->Photo6)->first();
			//dd($curr_photos);
			foreach ($curr_photos as $k => $v) {
				if (null != $v) {
					if(!in_array($v->Image_Name, $center_photo_name_lists)) {
						$new_collection[$v->Image_Name] =
						[
							//'center_id'   => $value->CenterID,
							'path'        => $v->Image_Name,
							'description' => $v->Description,
							'alt'         => $v->Alt,
							'caption'     => $v->Caption
						];
					}	
				} else {
					if(!in_array($value->$k, $center_photo_name_lists)) {
						$new_collection[$value->$k] =
						[
							'path'        => $value->$k,
							'description' => '',
							'alt'         => '',
							'caption'     => ''
						];
					}
				}

				$bar->advance();

			}
			$curr_photos = [];
		}
		//dd(count($new_collection));
		$break            = false;
		$final_collection = [];
		// dd(count($new_collection));
		// foreach ($new_collection as $item) {
		// 	foreach ($final_collection as $value) {
		// 		if ($item['path'] == $value['path']) {
		// 			$break = true;
		// 			break;
		// 		}

		// 	}
		// 	if ($break) {
		// 		$break = false;
		// 		break;
		// 	}
		// 	$final_collection[] = $item;
		// }
		DB::setDefaultConnection('mysql');
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('photos')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function vo_photos() {
		$this->info("\n migrating vo_photos table");
		//DB::setDefaultConnection('mysql');
		//DB::table('vo_photos')->truncate();
		$this->make_new_connection();
		$collection = DB::table('Center')->get();
		$bar        = $this->output->createProgressBar(count($collection));
		$vo_photos  = [];
		DB::setDefaultConnection('mysql');
		$center_ids = DB::table('centers')->lists('old_id','id');
		$photo_id_lists = DB::table('vo_photos')->lists('photo_id');
		$vo_centers_id_lists = DB::table('vo_photos')->lists('center_id');
		$vo_photos = [];
		//dd($photo_id_lists);
		foreach ($collection as $center) {
			$center_photos = [$center->Photo1, $center->Photo2, $center->Photo3, $center->Photo4, $center->Photo5, $center->Photo6];
			if(in_array($center->CenterID, $center_ids)) {
				$center_id = array_search($center->CenterID, $center_ids);
				if(!in_array($center_id, $vo_centers_id_lists)) {
					foreach ($center_photos as $center_photo) {
						if ((null != $unique_image = DB::table('photos')->where('path', $center_photo)->first()) && ($center_photo != null || $center_photo != '')) {
							$vo_photos[] = ['center_id' => $center_id, 'photo_id' => $unique_image->id];
						}
					}
				}
			}
			
		}
		if(!empty($vo_photos)) {
			DB::table('vo_photos')->insert($vo_photos);
		}
		$this->info('count '.count($vo_photos));
		$bar->finish();
		$this->info(' ✔');
	}

	private function virtual_offices_seos() {
		$this->info("\n migrating virtual_offices_seos table");
		$this->make_new_connection();
		$collection = DB::table('Center_SEO')->get();
		$bar        = $this->output->createProgressBar(count($collection));
		DB::setDefaultConnection('mysql');
		$center_ids = DB::table('centers')->lists('old_id','id');
		$center_id_lists = DB::table('centers')->lists('old_id');
		$seo_data = DB::table('virtual_offices_seos')->get();
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(empty($seo_data)) {
				if(in_array($value->Center_ID, $center_id_lists)) {
					if(in_array($value->Center_ID, $center_ids)) {
						$center_id = array_search($value->Center_ID, $center_ids);
						$new_collection[] =
						[
							'center_id'        => $center_id,
							'sentence1'        => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Sentence_1) ? utf8_decode($value->Sentence_1) : $value->Sentence_1,
							'sentence2'        => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Sentence_2) ? utf8_decode($value->Sentence_2) : $value->Sentence_2,
							'sentence3'        => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Sentence_3) ? utf8_decode($value->Sentence_3) : $value->Sentence_3,
							'avo_description'  => preg_match('/[^a-zA-Z1-9( ,-]/', $value->AVO_Description) ? utf8_decode($value->AVO_Description) : $value->AVO_Description,
							'meta_title'       => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Meta_Title) ? utf8_decode($value->Meta_Title) : $value->Meta_Title,
							'meta_description' => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Meta_Description) ? utf8_decode($value->Meta_Description) : $value->Meta_Description,
							'meta_keywords'    => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Meta_Keywords) ? utf8_decode($value->Meta_Keywords) : $value->Meta_Keywords,
							'h1'               => preg_match('/[^a-zA-Z1-9( ,-]/', $value->H1) ? utf8_decode($value->H1) : $value->H1,
							'h2'               => preg_match('/[^a-zA-Z1-9( ,-]/', $value->H2) ? utf8_decode($value->H2) : $value->H2,
							'h3'               => preg_match('/[^a-zA-Z1-9( ,-]/', $value->H3) ? utf8_decode($value->H3) : $value->H3,
							'seo_footer'       => preg_match('/[^a-zA-Z1-9( ,-]/', $value->SEO_Footer) ? utf8_decode($value->SEO_Footer) : $value->SEO_Footer,
							'abcn_description' => preg_match('/[^a-zA-Z1-9( ,-]/', $value->ABCN_Description) ? utf8_decode($value->ABCN_Description) : $value->ABCN_Description,
							'abcn_title'       => preg_match('/[^a-zA-Z1-9( ,-]/', $value->ABCN_Title) ? utf8_decode($value->ABCN_Title) : $value->ABCN_Title,
							'subhead'          => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Subhead) ? utf8_decode($value->Subhead) : $value->Subhead,
						];
					}
				}
			}
			
				
			$bar->advance();
		}
		//DB::table('virtual_offices_seos')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('virtual_offices_seos')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function virtual_offices_options(){
		$this->info("\n migrating virtual_offices_options table");
		$this->make_new_connection();
		$collection = DB::table('Center_Features')->get();		
		$bar        = $this->output->createProgressBar(count($collection));
		DB::setDefaultConnection('mysql');
		$center_ids = DB::table('centers')->lists('old_id','id');
		$center_id_lists = DB::table('virtual_offices_options')->lists('center_id');
		$new_collection = [];
		foreach ($collection as $key => $value) {	
			if(!in_array(array_search($value->CenterID, $center_ids), $center_id_lists)) {
				//dd($value->CenterID);
				$center_id = array_search($value->CenterID, $center_ids);
			
				//dd($center_id);
				$new_collection[] =
				[
					'center_id'        => $center_id,
					'option'           => $value->Name,
					'value'            => $value->Value
				];
			}
		
				
			$bar->advance();
		}
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('virtual_offices_options')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function meeting_rooms_seos() {
		$this->info("\n migrating meeting_rooms_seos table");
		$this->make_new_connection();
		$collection = DB::table('Center_SEO_MR')->get();
		DB::setDefaultConnection('mysql');
		$center_ids = DB::table('centers')->lists('old_id','id');
		$bar        = $this->output->createProgressBar(count($collection));
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if (in_array($value->Center_ID, $center_ids)) {
				$center_id = array_search($value->Center_ID, $center_ids);
				if(!in_array($center_id, $center_ids)) {
					$new_collection[] =
					[
						'center_id'        => $center_id,
						'sentence1'        => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Sentence_1) ? utf8_decode($value->Sentence_1) : $value->Sentence_1,
						'sentence2'        => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Sentence_2) ? utf8_decode($value->Sentence_2) : $value->Sentence_2,
						'sentence3'        => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Sentence_3) ? utf8_decode($value->Sentence_3) : $value->Sentence_3,
						'avo_description'  => preg_match('/[^a-zA-Z1-9( ,-]/', $value->AVO_Description) ? utf8_decode($value->AVO_Description) : $value->AVO_Description,
						'meta_title'       => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Meta_Title) ? utf8_decode($value->Meta_Title) : $value->Meta_Title,
						'meta_description' => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Meta_Description) ? utf8_decode($value->Meta_Description) : $value->Meta_Description,
						'meta_keywords'    => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Meta_Keywords) ? utf8_decode($value->Meta_Keywords) : $value->Meta_Keywords,
						'h1'               => preg_match('/[^a-zA-Z1-9( ,-]/', $value->H1) ? utf8_decode($value->H1) : $value->H1,
						'h2'               => preg_match('/[^a-zA-Z1-9( ,-]/', $value->H2) ? utf8_decode($value->H2) : $value->H2,
						'h3'               => preg_match('/[^a-zA-Z1-9( ,-]/', $value->H3) ? utf8_decode($value->H3) : $value->H3,
						'seo_footer'       => preg_match('/[^a-zA-Z1-9( ,-]/', $value->SEO_Footer) ? utf8_decode($value->SEO_Footer) : $value->SEO_Footer,
						'abcn_description' => preg_match('/[^a-zA-Z1-9( ,-]/', $value->ABCN_Description) ? utf8_decode($value->ABCN_Description) : $value->ABCN_Description,
						'abcn_title'       => preg_match('/[^a-zA-Z1-9( ,-]/', $value->ABCN_Title) ? utf8_decode($value->ABCN_Title) : $value->ABCN_Title,
						'subhead'          => preg_match('/[^a-zA-Z1-9( ,-]/', $value->Subhead) ? utf8_decode($value->Subhead) : $value->Subhead,
					];
				}
				
			}

			$bar->advance();
		}
		//DB::table('meeting_rooms_seos')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('meeting_rooms_seos')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function centers_filters() {
		$this->info("\n migrating centers_filters table");
		DB::setDefaultConnection('mysql');
		DB::table('centers_filters')->truncate();
		$centers = DB::table('centers')->get();
		$center_filters = DB::table('centers_filters')->get();
		$centers_filters_center_id_lists = DB::table('centers')->lists('old_id');
		$center_ids_lists  = DB::table('centers')->lists('old_id','id');
		$bar     = $this->output->createProgressBar(count($centers));
		$this->make_new_connection();
		$new_collection = [];
		foreach ($centers as $center) {
			if (null != $filter = DB::table('Center_Filter')->where('Center_ID', $center->old_id)->first()) {
				if(empty($center_filters)) {
					if(in_array($filter->Center_ID, $center_ids_lists) ) {
						$center_id = array_search($filter->Center_ID, $center_ids_lists);
						$new_collection[] =
						[
							'center_id'      => $center_id,
							'virtual_office' => $filter->Approval_1 == 'Approved'?true:false,
							'office'         => $filter->Approval_2 == 'Approved'?true:false,
							'meeting_room'   => $filter->Approval_3 == 'Approved'?true:false,
						];
					}
				} else {
					if(!in_array($filter->Center_ID, $centers_filters_center_id_lists)) {
						if(in_array($filter->Center_ID, $center_ids_lists) ) {
							$center_id = array_search($filter->Center_ID, $center_ids_lists);
							$new_collection[] =
							[
								'center_id'      => $center_id,
								'virtual_office' => $filter->Approval_1 == 'Approved'?true:false,
								'office'         => $filter->Approval_2 == 'Approved'?true:false,
								'meeting_room'   => $filter->Approval_3 == 'Approved'?true:false,
							];
						}	
					}
				}
				
				//dump($new_collection);
				DB::setDefaultConnection('mysql');
				//dd($new_collection);
				$this->info('count'.count($new_collection));
				if(!empty($new_collection)) {
					DB::table('centers_filters')->insert($new_collection);
					$new_collection = [];
				}
				$this->make_new_connection();
			}
			$bar->advance();
		}
		
		//DB::table('centers_filters')->truncate();
		
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function centers_prices() {
		$this->info("\n migrating centers_prices table");
		$this->make_new_connection();
		$prices = DB::table('Center_Package_Pricing')->get();
		$bar    = $this->output->createProgressBar(count($prices));
		DB::setDefaultConnection('mysql');
		$center_ids  = DB::table('centers')->lists('old_id');
		$center_ids_lists  = DB::table('centers')->lists('old_id','id');
		$package_ids = DB::table('packages')->lists('id');
		$center_prices_id_lists = DB::table('center_prices')->lists('center_id');
		$new_collection = [];
		foreach ($prices as $price) {
			if(in_array($price->Center_ID, $center_ids) && in_array($price->Package_ID, $package_ids)) {
				$center_id = array_search($price->Center_ID, $center_ids_lists);
				if(!in_array($center_id, $center_prices_id_lists)) {
					$new_collection[] =
					[
						'center_id'                         => $center_id,
						'package_id'                        => $price->Package_ID,
						'price'                             => $price->Price,
						'with_live_receptionist_pack_price' => $price->Price+85,
						'with_live_receptionist_full_price' => $price->Price+95,
						'updated_at'                        => date('Y-m-d H:i:s', $price->Modify_Date)
					];
				}
				
			}
			
			$bar->advance();
		}
		//DB::table('centers_prices')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('center_prices')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	public function products() {
		$this->info("\n migrating packages table");
		DB::setDefaultConnection('mysql');
		$packages_id_lists = DB::table('packages')->lists('id');
		$this->make_new_connection();
		$products = DB::table('Products')->get();
		$bar      = $this->output->createProgressBar(count($products));
		$new_collection = [];
		foreach ($products as $product) {
			if(!in_array($product->Object_ID, $packages_id_lists)) {
				$new_collection[] =
				[
					'id'          => $product->Object_ID,
					'part_number' => $product->Part_Number,
					'name'        => $product->Name,
					'price'       => $product->Price,
					'created_at'  => date('Y-m-d H:i:s', $product->Date_Added),
					'updated_at'  => date('Y-m-d H:i:s', $product->Date_Added)
				];
			}
			$bar->advance();
		} 
		DB::setDefaultConnection('mysql');
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('packages')->insert($new_collection);
			$new_collection = [];
		}
		//DB::table('products')->truncate();
		$bar->finish();
		$this->info(' ✔');
	}

	private function cities() {
        $this->info("\n migrating cities table");
        $this->make_new_connection();
        $count        = 0;
        $states       = $this->usStates->getStates();
        $other_cities = $this->countryCities->getCities();
        //cityInformationAVONew
        $business_infos   = DB::table('cityInformationAVONew')->lists('business_info', 'name');
        $general_infos    = DB::table('cityInformationAVONew')->lists('general_info', 'name');
        $bar_other_ciites = $this->output->createProgressBar(count($other_cities));
        DB::setDefaultConnection('mysql');
        //DB::table('cities')->truncate();
        $us             = DB::table('countries')->where('code', 'US')->first();
        $us_id          = $us->id;
        $us_state_ids   = DB::table('us_states')->lists('id', 'name');
        $us_state_codes = DB::table('us_states')->lists('code', 'name');
        $key            = 0;
        //dd($us_state_ids);
        //dd('ass');
        $cities_name_lists = DB::table('cities')->lists('name');
        $cities = [];
        foreach ($states as $st_name => $state) {
            foreach ($state as $city) {
                if ($count%250 == 0) {
                    $key++;
                }
                if(!in_array($city, $cities_name_lists)) {
                	$cities[$key][] =
                	[
                	    'name'          => $city,
                	    'us_state'      => $st_name,
                	    'slug'          => str_slug($city),
                	    'us_state_id'   => $us_state_ids["$st_name"],
                	    'us_state_code' => $us_state_codes["$st_name"],
                	    'country_code'  => $us->code,
                	    'business_info' => isset($business_infos[strtolower($city)])?$business_infos[strtolower($city)]:'',
                	    'general_info'  => isset($general_infos[strtolower($city)])?$general_infos[strtolower($city)]:'',
                	    'country_id'    => $us_id
                	];
                }
                $count++;

            }

        }
        $bar_states = $this->output->createProgressBar(count($cities));
        if(!empty($cities)) {
        	foreach ($cities as $key => $city) {
        	    DB::table('cities')->insert($city);
        	    $cities_name_lists[] = $city;
                $city = [];
        	    $bar_states->advance();
        	}
        }
        
        $bar_states->finish();
        $this->info(" :heavy_check_mark:\n");

        $this->info(" migrating other cities table");
        $countries_name_lists = DB::table('cities')->where('us_state_code', null)->lists('name');
        $countries_codes_lists = DB::table('cities')->lists('country_code');

        $arr = [];
        foreach ($other_cities as $country => $cities) {
            $country_obj = DB::table('countries')->where('name', $country)->first();
            if (null != $country_obj) {
                foreach ($cities as $city) {
                	if(!in_array($city, $countries_name_lists) || (in_array($city, $countries_name_lists) && !in_array($country_obj->code, $countries_codes_lists))) {
                		$arr =
                		[
                		    'name'          => $city,
                		    'us_state'      => null,
                		    'slug'          => str_slug($city),
                		    'us_state_id'   => null,
                		    'us_state_code' => null,
                		    'country_code'  => $country_obj->code,
                		    'country_id'    => $country_obj->id,
                		    'business_info' => isset($business_infos[strtolower($city)])?$business_infos[strtolower($city)]:'',
                		    'general_info'  => isset($general_infos[strtolower($city)])?$general_infos[strtolower($city)]:''
                		];
                	}
                	if(!empty($arr)) {
                		DB::table('cities')->insert($arr);
                		$countries_name_lists[] = $arr['name'];
                		$arr = [];
                	}
                }
            } else {

            }
            $bar_other_ciites->advance();
        }
        $bar_other_ciites->finish();
        $this->info(" :heavy_check_mark:");
    }

	// private function cities() {
 //        $this->info("\n migrating cities table");
 //        $this->make_new_connection();
 //        $count        = 0;
 //        $states       = $this->usStates->getStates();
 //        $other_cities = $this->countryCities->getCities();
 //        //cityInformationAVONew
 //        $business_infos   = DB::table('cityInformationAVONew')->lists('business_info', 'name');
 //        $general_infos    = DB::table('cityInformationAVONew')->lists('general_info', 'name');
 //        $bar_other_ciites = $this->output->createProgressBar(count($other_cities));
 //        DB::setDefaultConnection('mysql');
 //        //DB::table('cities')->truncate();
 //        $us             = DB::table('countries')->where('code', 'US')->first();
 //        $us_id          = $us->id;
 //        $us_state_ids   = DB::table('us_states')->lists('id', 'name');
 //        $us_state_codes = DB::table('us_states')->lists('code', 'name');
 //        $key            = 0;

 //        foreach ($states as $st_name => $state) {
 //            foreach ($state as $city) {
 //                if ($count%250 == 0) {
 //                    $key++;
 //                }
 //                $cities[$key][] =
 //                [
 //                    'name'          => $city,
 //                    'us_state'      => $st_name,
 //                    'slug'          => str_slug($city),
 //                    'us_state_id'   => $us_state_ids["$st_name"],
 //                    'us_state_code' => $us_state_codes["$st_name"],
 //                    'country_code'  => $us->code,
 //                    'business_info' => isset($business_infos[strtolower($city)])?$business_infos[strtolower($city)]:'',
 //                    'general_info'  => isset($general_infos[strtolower($city)])?$general_infos[strtolower($city)]:'',
 //                    'country_id'    => $us_id
 //                ];
 //                $count++;
 //            }

 //        }

 //        $bar_states = $this->output->createProgressBar(count($cities));
 //        foreach ($cities as $key => $city) {
 //            DB::table('cities')->insert($city);
 //            $bar_states->advance();
 //        }
 //        $bar_states->finish();
 //        $this->info(" :heavy_check_mark:\n");

 //        $this->info(" migrating other cities table");
 //        foreach ($other_cities as $country => $cities) {
 //            $country_obj = DB::table('countries')->where('name', $country)->first();
 //            if (null != $country_obj) {
 //                foreach ($cities as $city) {
 //                    $arr =
 //                    [
 //                        'name'          => $city,
 //                        'us_state'      => null,
 //                        'slug'          => str_slug($city),
 //                        'us_state_id'   => null,
 //                        'us_state_code' => null,
 //                        'country_code'  => $country_obj->code,
 //                        'country_id'    => $country_obj->id,
 //                        'business_info' => isset($business_infos[strtolower($city)])?$business_infos[strtolower($city)]:'',
 //                        'general_info'  => isset($general_infos[strtolower($city)])?$general_infos[strtolower($city)]:''
 //                    ];
 //                    DB::table('cities')->insert($arr);
 //                }
 //            } else {

 //            }
 //            $bar_other_ciites->advance();
 //        }
 //        $bar_other_ciites->finish();
 //        $this->info(" :heavy_check_mark:");
 //    }

	private function detect_active_cities() {
		$this->info("\n detecting active cities in system");
		DB::setDefaultConnection('mysql');
		$cities = DB::table('cities')->get();
		$count  = 0;
		$key    = 0;
		$bar    = $this->output->createProgressBar(count($cities));
		foreach ($cities as $key => $value) {
			if (DB::table('centers')->where('city_id', $value->id)->where('active_flag', 'Y')->first() != null) {
				DB::table('cities')->where('id', $value->id)->update(['active' => 1]);				
			} else {
			}
			$count++;
			$bar->advance();
		}
		$bar->finish();
		$this->info('✔');
	}

	private function countries() {
		$this->info("\n migrating countries table");
		$all_countries = $this->_countries->getCountries();
		$bar           = $this->output->createProgressBar(count($all_countries));
		DB::setDefaultConnection('mysql');
		$countries = DB::table('countries')->get();
		$countries_name_lists = DB::table('countries')->lists('name');
		$new_collection = [];
		foreach ($all_countries as $country) {
			if(!in_array($country['name'], $countries_name_lists)) {
				$new_collection[] =
				[
					'name' => $country['name'],
					'code' => $country['code'],
					'slug' => str_slug($country['name'])
				];
			}
			
			$bar->advance();
		}
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('countries')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function users_files() {
		$this->info("\n migrating users_files table");
		DB::setDefaultConnection('mysql');
		$users_files_id_lists = DB::table('users_files')->lists('id');
		$this->make_new_connection();
		$collection = DB::table('Customers_Files')->get();
		$bar        = $this->output->createProgressBar(count($collection));
		DB::setDefaultConnection('mysql');
		$users_ids = DB::table('users')->lists('old_id', 'id');
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->File_ID, $users_files_id_lists)) {
				if(in_array($value->Customer_ID, $users_ids)) {
					$user_id = array_search($value->Customer_ID, $users_ids);
				}
				$new_collection[] =
				[
					'id'            => $value->File_ID,
					//'old_id'        => $value->Customer_ID,
					'user_id'       => $user_id,
					'file_type'     => $value->File_Type,
					'uploaded_by'   => $value->Uploaded_By,
					'path'          => $value->File_Name,
					'file_category' => $value->File_Category,
					'created_at'    => date('Y-m-d H:i:s', $value->Upload_Time)
				];
				$bar->advance();
			}
		}
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('users_files')->insert($new_collection);
			$new_collection = [];
		}
		
		//DB::table('users_files')->truncate();
		
		$bar->finish();
		$this->info(' ✔');

	}

	private function owners() {
        $this->info("\n migrating owners table");
        DB::setDefaultConnection('mysql');
        $old_owners_id_lists = DB::table('users')->lists('old_owner_id');
    	$this->make_new_connection();
    	$collection = DB::table('Center_Owner')->get();
    	$passwords =  DB::table('Owner_Logins')->lists('Password', 'Owner_ID');
    	//$passwords = DB::table('Customer_Hashes')->lists('Password', 'Customer_ID');
    	$bar        = $this->output->createProgressBar(count($collection));
    	$emails = [];
    	$duplicate_emails = [];
    	$new_collection = [];
    	$new_collection_owners = [];
    	foreach($collection as $key => $value){
    		if(!in_array($value->OwnerID, $old_owners_id_lists)) {
    			$value->Email = strtolower($value->Email);
    			if(in_array($value->Email, $emails)){
    			    $value->Email = $value->OwnerID.'_'.$value->Email;
    			    $emails[] = $value->Email;
    			    $email = $value->Email;
    			    //DB::table('users')->where('id', $id)->update(['email' => $collection[$id]]);  
    			} 
    			else {
    			    $emails[] = $value->Email;
    			    $email = $value->Email;
    			}
    			$new_collection[] =
    			[
    			    'old_owner_id'           => $value->OwnerID,
    			    'company_name' => $value->CompanyName,
    			    'owner_name' => $value->OwnerName,
    			    'phone'    => $value->Phone,
    			    'fax'      => $value->Fax,
    			    'url'      => $value->URL,
    			    'email'    => $email,
    			    'address1' => $value->Address1,
    			    'address2' => $value->Address2,
    			    'role_id'  => 5,
    			    'password'        => isset($passwords[$value->OwnerID]) ? bcrypt($passwords[$value->OwnerID]) : null,
    			    //'city_id'      => '------------',
    			    //'region_id'    => '------------',
    			    //'us_state_id'  => '------------',
    			    //'country_id'   => '------------',
    			    'postal_code'  => $value->PostalCode,               
    			];
    			$new_collection_owners[] =
    			[
    			    'id'           => $value->OwnerID,
    			    'company_name' => $value->OwnerName,
    			    'phone'    => $value->Phone,
    			    'fax'      => $value->Fax,
    			    // 'url'      => $value->URL,
    			    'email'    => $value->Email,
    			    'address1' => $value->Address1,
    			    'address2' => $value->Address2,
    			    'role_id'  => 5,
    			    //'city_id'      => '------------',
    			    //'region_id'    => '------------',
    			    //'us_state_id'  => '------------',
    			    //'country_id'   => '------------',
    			    'postal_code'  => $value->PostalCode,               
    			];
    		}
    	    
    	    $bar->advance();  
    	}
    	//dd($new_collection[2]);
    	// foreach ($collection as $key => $value) {
    	//     //dd($collection);
    	//     $new_collection[] =
    	//     [
    	//         'id'           => $value->OwnerID,
    	//         'company_name' => $value->OwnerName,
    	//         'phone'    => $value->Phone,
    	//         'fax'      => $value->Fax,
    	//         // 'url'      => $value->URL,
    	//         'email'    => $value->Email,
    	//         'address1' => $value->Address1,
    	//         'address2' => $value->Address2,
    	//         'role_id'  => 5,
    	//         //'city_id'      => '------------',
    	//         //'region_id'    => '------------',
    	//         //'us_state_id'  => '------------',
    	//         //'country_id'   => '------------',
    	//         'postal_code'  => $value->PostalCode,               
    	//     ];
    	//     $new_collection_owners[] =
    	//     [
    	//         'id'           => $value->OwnerID,
    	//         'company_name' => $value->OwnerName,
    	//         'phone'    => $value->Phone,
    	//         'fax'      => $value->Fax,
    	//         // 'url'      => $value->URL,
    	//         'email'    => $value->Email,
    	//         'address1' => $value->Address1,
    	//         'address2' => $value->Address2,
    	//         'role_id'  => 5,
    	//         //'city_id'      => '------------',
    	//         //'region_id'    => '------------',
    	//         //'us_state_id'  => '------------',
    	//         //'country_id'   => '------------',
    	//         'postal_code'  => $value->PostalCode,               
    	//     ];
    	//     $bar->advance();
    	// }
    	DB::setDefaultConnection('mysql');
    	//DB::table('owners')->truncate();
    	$this->info('count'.count($new_collection));
    	if(!empty($new_collection)) {
    		DB::table('users')->insert($new_collection);
    		$new_collection = [];
    	}
    	if(!empty($new_collection)) {
    		DB::table('owners')->insert($new_collection_owners);
    		$new_collection_owners = [];
    	}
    	
    	$bar->finish();
    	$this->info(' ✔');
    }

	private function regions() {
		$this->info("\n migrating regions table");
		$this->make_new_connection();
		$collection = DB::table('Region')->get();
		DB::setDefaultConnection('mysql');
		$regions = DB::table('regions')->get();
		$regions_name_lists = DB::table('regions')->lists('name');
		$bar        = $this->output->createProgressBar(count($collection));
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->Region, $regions_name_lists)) {
				$new_collection[] =
				[
					'name'         => $value->Region,
					'email'        => $value->Email,
					'contact_info' => $value->ContactInfo
				];
			}
			
			$bar->advance();
		}
		DB::setDefaultConnection('mysql');
		//DB::table('regions')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('regions')->insert($new_collection);
			$new_collection = [];
		}
		
		$bar->finish();
		$this->info(' ✔');
	}

	private function us_states() {
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
        foreach ($new_collection as $key => $value) {
            $new_collection[$key]['slug'] = str_slug($value['name']);
            $bar->advance();
        }
        DB::setDefaultConnection('mysql');
        //DB::table('us_states')->truncate();
        DB::table('us_states')->insert($new_collection);
        $bar->finish();
        $this->info(' :heavy_check_mark:');

    }

	private function users() {
		$this->info("\n migrating users table");
		DB::setDefaultConnection('mysql');
		$users_old_id_lists = DB::table('users')->lists('old_id');
		//dd(in_array(7473, $users_old_id_lists));
		$this->make_new_connection();
		$collection = DB::table('Customers')->get();
		$bar        = $this->output->createProgressBar(count($collection));
		$max        = DB::table('Customers')->count();

		$passwords = DB::table('Customer_Hashes')->lists('Password', 'Customer_ID');
		DB::setDefaultConnection('mysql');
		//DB::table('users')->truncate();

		$counter        = 0;
		$int_perc       = 0;
		$new_collection = [];
		$count          = 0;
		$emails = [];
        $duplicate_emails = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->Customer_ID, $users_old_id_lists)) {
				$value->Email = strtolower($value->Email);
				if(in_array($value->Email, $emails)){
				    $value->Email = $value->Customer_ID.'_'.$value->Customer_ID.'_'.$value->Email;
				    $emails[] = $value->Email;
				    $email = $value->Email;
				    //DB::table('users')->where('id', $id)->update(['email' => $collection[$id]]);  
				} 
				else {
				    $emails[] = $value->Email;
				    $email = $value->Email;
				}

				$new_collection[] =
				[
					'old_id'        => $value->Customer_ID,
					'first_name'    => $value->First_Name,
					'last_name'     => $value->Last_Name,
					'company_name'  => $value->Company_Name,
					'email'         => $email,
					'username'      => $value->Username,
					'phone'         => $value->Phone1,
					'passwrod_hint' => $value->Password_Hint,
					'address1'      => $value->Address1,
					'address2'      => $value->Address2,
					//'city_id'         => '---------------',
					//'us_state_id'     => '---------------',
					'postal_code' => $value->Postal_Code,
					//'country_id'      => '---------------',
					'password'        => isset($passwords[$value->Customer_ID])?$passwords[$value->Customer_ID]:null,
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
				$count++;
				if ($count%250 == 0) {
					DB::table('users')->insert($new_collection);
					$count          = 0;
					$new_collection = [];
				}
				$bar->advance();
			}
		}
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {	
			DB::table('users')->insert($new_collection);
			$new_collection = [];
		}
		$bar->finish();
		$this->info(' ✔');
	}

	private function meeting_rooms() {
		$this->info("\n migrating meeting_rooms table");
		$this->make_new_connection();
		$meeting_rooms = DB::table('Meeting_Rooms')->get();
		$bar           = $this->output->createProgressBar(count($meeting_rooms));
		DB::setDefaultConnection('mysql');
		$center_ids_lists  = DB::table('centers')->lists('old_id','id');
		$mr_id_lists = DB::table('meeting_rooms')->lists('id');
		$new_collection = [];
		foreach ($meeting_rooms as $room) {
			if(in_array($room->Center_ID, $center_ids_lists)) {
				$center_id = array_search($room->Center_ID, $center_ids_lists);
				if(!in_array($room->Meeting_Room_ID, $mr_id_lists)) {
					$new_collection[] =
					[
						'id'            => $room->Meeting_Room_ID,
						'center_id'     => $center_id,
						'name'          => $room->Name,
						'capacity'      => $room->Capacity,
						'hourly_rate'   => $room->Hourly_Rate,
						'half_day_rate' => $room->Half_Day_Rate,
						'full_day_rate' => $room->Full_Day_Rate,
						'min_hours_req' => $room->Min_Hours_Req,
						'floor'         => $room->Floor
					];
				}	
			}
			$bar->advance();
		}

		DB::setDefaultConnection('mysql');
		//DB::table('meeting_rooms')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('meeting_rooms')->insert($new_collection);
			$new_collection = [];
		}
		$bar->finish();
		$this->info(' ✔');
	}

	// private function meeting_rooms_options() {
	// 	$this->info("\n migrating meeting_rooms_options table");
	// 	$this->make_new_connection();
	// 	$meeting_rooms_options = DB::table('Meeting_Room_Options')->get();
	// 	$bar                   = $this->output->createProgressBar(count($meeting_rooms_options));
	// 	DB::setDefaultConnection('mysql');
	// 	$meeting_room_ids = DB::table('meeting_rooms')->lists('id');
	// 	$new_collection   = [];
	// 	foreach ($meeting_rooms_options as $option) {
	// 		if (!in_array($option->Meeting_Room_ID, $meeting_room_ids)) {
	// 			//dd($option->Meeting_Room_ID);
	// 			$new_collection[] =
	// 			[
	// 				'meeting_room_id'             => $option->Meeting_Room_ID,
	// 				'room_description'            => $option->Room_Description,
	// 				'parking_rate'                => $option->Parking_Rate,
	// 				'parking_description'         => $option->Parking_Description,
	// 				'network_rate'                => $option->Network_Rate,
	// 				'wireless_rate'               => $option->Wireless_Rate,
	// 				'phone_rate'                  => $option->Phone_Rate,
	// 				'admin_services_rate'         => $option->Admin_Services_Rate,
	// 				'whiteboard_rate'             => $option->Whiteboard_Rate,
	// 				'tvdvdplayer_rate'            => $option->Tvdvdplayer_Rate,
	// 				'projector_rate'              => $option->Projector_Rate,
	// 				'videoconferencing_rate'      => $option->Videoconferencing_Rate,
	// 				'video_equipment'             => $option->Video_Equipment,
	// 				'bridge_connection_available' => $option->Bridge_Connection_Available,
	// 				'catering'                    => $option->Catering,
	// 				'credit_cards'                => $option->Credit_Cards
	// 			];
	// 		}
	// 		$bar->advance();
	// 	}

	// 	//DB::table('meeting_rooms_options')->truncate();
	// 	if(!empty($new_collection)) {
	// 		DB::table('meeting_rooms_options')->insert($new_collection);
	// 		$new_collection = [];
	// 	}
		
	// 	$bar->finish();
	// 	$this->info(' ✔');
	// }

	private function meeting_rooms_options() {
        $this->info("\n migrating meeting_rooms_options table");
        DB::setDefaultConnection('mysql');
        DB::table('meeting_rooms_options')->truncate();
        $this->make_new_connection();
        $meeting_rooms_options = DB::table('Meeting_Room_Options')->get();
        $bar                   = $this->output->createProgressBar(count($meeting_rooms_options));
        DB::setDefaultConnection('mysql');
        $meeting_room_ids = DB::table('meeting_rooms')->lists('id');
        $new_collection   = [];
        foreach ($meeting_rooms_options as $option) {
            if (in_array($option->Meeting_Room_ID, $meeting_room_ids)) {
                $new_collection[] =
                [
                    'meeting_room_id'             => $option->Meeting_Room_ID,
                    'room_description'            => $option->Room_Description,
                    'parking_rate'                => $option->Parking_Rate,
                    'parking_description'         => $option->Parking_Description,
                    'network_rate'                => $option->Network_Rate,
                    'wireless_rate'               => $option->Wireless_Rate,
                    'phone_rate'                  => $option->Phone_Rate,
                    'admin_services_rate'         => $option->Admin_Services_Rate,
                    'whiteboard_rate'             => $option->Whiteboard_Rate,
                    'tvdvdplayer_rate'            => $option->Tvdvdplayer_Rate,
                    'projector_rate'              => $option->Projector_Rate,
                    'videoconferencing_rate'      => $option->Videoconferencing_Rate,
                    'video_equipment'             => $option->Video_Equipment,
                    'bridge_connection_available' => $option->Bridge_Connection_Available,
                    'catering'                    => $option->Catering,
                    'credit_cards'                => $option->Credit_Cards
                ];
            }
            $bar->advance();
        }

        //DB::table('meeting_rooms_options')->truncate();
        DB::table('meeting_rooms_options')->insert($new_collection);
        $bar->finish();
        $this->info(' :heavy_check_mark:');
    }

	private function tel_countries() {
		$this->info("\n migrating tel_countries table");
		DB::setDefaultConnection('mysql');
		$tel_countries_full_name_list = DB::table('tel_countries')->lists('full_name');
		$this->make_new_connection();
		$tel_countries = DB::table('tel_Countries')->get();
		$bar           = $this->output->createProgressBar(count($tel_countries));
		$new_collection = [];
		foreach ($tel_countries as $country) {
			if(!in_array($country->Full_Name, $tel_countries_full_name_list)) {
				$new_collection[] =
				[
					'country_code' => $country->Country_Code,
					'full_name'    => $country->Full_Name,
					'abbrv'        => $country->Abbrv,
					'logtime'      => $country->Logtime
				];
			}
			
			$bar->advance();
		}

		DB::setDefaultConnection('mysql');
		//DB::table('tel_countries')->truncate();
		$this->info('count'.count($new_collection));
		DB::table('tel_countries')->insert($new_collection);
		$bar->finish();
		$this->info(' ✔');
	}

	private function tel_prefixes() {
		$this->info("\n migrating tel_prefixes table");
		DB::setDefaultConnection('mysql');
		$prefixes_list = DB::table('tel_prefixes')->lists('prefix');
		$this->make_new_connection();
		$tel_prefixes = DB::table('tel_Prefixes')->get();
		$bar          = $this->output->createProgressBar(count($tel_prefixes));
		$new_collection = [];
		foreach ($tel_prefixes as $prefix) {
			if(!in_array($prefix->Prefix, $prefixes_list)) {
				$new_collection[] =
				[
					'country_code' => $prefix->Country_Code,
					'prefix'       => $prefix->Prefix,
					'logtime'      => $prefix->Logtime,
				];
			}
			
			$bar->advance();
		}

		DB::setDefaultConnection('mysql');
		//DB::table('tel_prefixes')->truncate();
		$this->info('count'.count($new_collection));
		DB::table('tel_prefixes')->insert($new_collection);
		$bar->finish();
		$this->info(' ✔');
	}
	private function telephony_package_includes() {
		$this->info("\n migrating telephony_package_includes table");
		$this->make_new_connection();
		$telephony_package_includes = DB::table('Telephony_Package_Includes')->get();
		$bar                        = $this->output->createProgressBar(count($telephony_package_includes));
		DB::setDefaultConnection('mysql');
		$center_ids     = DB::table('centers')->lists('old_id','id');
		$package_ids    = DB::table('centers')->lists('old_id');
		$telephony_package_includes_center_id_ists    = DB::table('telephony_package_includes')->lists('center_id');
		$new_collection = [];
		foreach ($telephony_package_includes as $include) {
			if (!in_array($include->Center_ID, $center_ids) && in_array($include->Package, $package_ids)) {
				$center_id = array_search($include->Center_ID, $center_ids);
				if(!in_array($center_id, $telephony_package_includes_center_id_ists)) {
					$new_collection[] =
					[
						'center_id'  => $center_id,
						'package_id' => $include->Package,
						'include'    => $include->Include,
						'place'      => $include->Place,
					];
				}
				
			}
			$bar->advance();
		}

		//DB::table('telephony_package_includes')->truncate();
		$this->info('count'.count($new_collection));
		if(!empty($new_collection)) {
			DB::table('telephony_package_includes')->insert($new_collection);
			$new_collection = [];
		}
		
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

	private function location_SEO() {
		$this->info("\n migrating location_SEO table");
		DB::setDefaultConnection('mysql');
		$cities_countries_list = DB::table('location_SEO')->lists('City', 'Country');
		$cities = DB::table('location_SEO')->lists('City');
		$countries = DB::table('location_SEO')->lists('Country');
		//DB::table('regions')->truncate();
		$this->make_new_connection();
		$collection = DB::table('Location_SEO')->get();
		$bar        = $this->output->createProgressBar(count($collection));
		$new_collection = [];
		foreach ($collection as $key => $value) {
			if(!in_array($value->City, $cities)) {
				$new_collection[] =
				[
					'City'         => $value->City,
					'State'        => $value->State,
					'Country' 	   => $value->Country,
					'Title'        => $value->Title,
					'H1'           => $value->H1,
					'H2'           => $value->H2,
					'Type'         => $value->Type,
				];
			}
			
			$bar->advance();
		}
		//dd($new_collection);
		DB::setDefaultConnection('mysql');
		//DB::table('regions')->truncate();
		$this->info('count'.count($new_collection));
		DB::table('location_SEO')->insert($new_collection);
		$bar->finish();
		$this->info(' ✔');

	}
}
