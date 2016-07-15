<?php
namespace App\Console\Helpers;

class CountryCities
{
	public function __construct()
	{
		$this->arr = 
		[
			'Algeria'        			=> ['Algiers'],
			'Australia'      			=> ['North Sydney', 'Brisbane', 'Edgecliff', 'Frankston','Perth', 'Malvern','Melbourne','Sydney', 'Walkerville', 'Spring Hill'],
			'Belgium'        			=> ['Brussels', 'Brussels Schuman', 'Gent', 'Kortrijk', 'Mechelen'],
			'Belize'         			=> ['Belize City'],
			'Brazil'         			=> ['Sao Paulo'],
			'Bulgaria'       			=> ['Sofia'],
			'Canada'         			=> ['Richmond Hill', 'Toronto', 'Vancouver'],
			'China'          			=> ['Beijing', 'Chengdu', 'Guangzhou', 'Macau', 'Shanghai', 'Shenzhen', 'Tianjian', 'Tianjin', 'Tianjian'],
			'Colombia'       			=> ['Bogota'],
			'Czech Republic' 			=> ['Prague', 'Prague1'],
			'Finland'                   => ['Helsonki'],
			'France'         			=> ['Angers', 'Bordeaux', 'Forbach', 'Grenoble', 'Le Mans', 'Lille', 'Lyon', 'Montpellier', 'Nantes', 'Nice', 'Paris', 'Rennes', 'Roissy', 'Sophia Antipolis', 'Terssac', 'Toulouse'],
			'Germany'        			=> ['Berlin', 'Bielefeld', 'Bremen', 'Cologne', 'Darmstadt', 'Dortmund', 'Dusseldorf', 'Eschborn', 'Essen', 'Frankfurt','Frankfurt am Main', 'Freiburg', 'Hamburg', 'Hannover', 'Leipzig', 'Magdeburg', 'Mainz', 'Munich', 'Munster', 'Potsdam', 'Saarbrucken', 'Stuttgart', 'Wiesbaden'],
			'Guadeloupe'     			=> ['Baie-Mahault'],
			'Guyana'         			=> ['Cayenne'],
			'Hong Kong'      			=> ['Hong Kong'],
			'Hungary'        			=> ['Budapest', 'Debrecen'],
			'India'          			=> ['Bangalore', 'Chennai', 'Gurgaon', 'Kolkata', 'Mumbai', 'New Delhi', 'Noida', 'Pune', 'Secunderabad'],
			'Indonesia'      			=> ['Jakarta'],
			'Ireland'        			=> ['Dublin'],
			'Italy'          			=> ['Milan', 'Rome'],
			'Japan'          			=> ['Tokyo'],
			'Korea, Republic of'		=> ['Seoul'],
			'Luxembourg'        		=> ['Luxembourg'],
			'Martinique'        		=> ['Fort de france'],
			'Mexico'            		=> ['Cd. Juarez', 'Col. Del Valle', 'Col. Valle del Campestre', 'Deleg. Miguel Hidalgo', 'Delegación Miguel Hidalgo', 'Guadalajara', 'Mexico City', 'Mexico D.F.', 'Monterrey', 'Monterrey (San Pedro)', 'Naucalpan de Juarez', 'Puebla', 'Queretaro', 'San Pedro Garza Garcia', 'Tijuana, Baja California'],
			'Netherlands'       		=> ['Almere', 'Amersfoort', 'Amstelveen', 'Amsterdam', 'Andelst', 'Apeldoorn', 'Arnhem', 'Ede', 'Gouda', 'Nieuwegein', 'Utrecht'],
			'Panama'            		=> ['Panama City'],
			'Peru'              		=> ['Lima'],
			'Philippines'       		=> ['Makati City'],
			'Qatar'             		=> ['Doha'],
			'Romania'           		=> ['Bucharest'],
			'Russian Federation'		=> ['Moscow'],
			'Singapore'         		=> ['Singapore'],
			'Spain'             		=> ['Palma de Mallorca'],
			'Sweden'            		=> ['Malmo', 'Stockholm'],
			'Switzerland'       		=> ['Huenenberg', 'PfÃffikon', 'Stans', 'Zurich'],
			'Taiwan, Republic Of China' => ['Taipei'],
			'Turkey'                    => ['Ankara', 'Istanbul'],
			'United Arab Emirates'      => ['Dubai'],
			'United Kingdom'            => ['Birmingham', 'Brentford', 'Bristol', 'Canary Wharf', 'Cardiff', 'Cardiff Waterside', 'Central Milton Keynes', 'London', 'London City', 'London Mayfair', 'London Notting Hill', 'London West End', 'Newport', 'Nottingham', 'Reading', 'Solihull', 'Wakefield']
		];
	}

	public function getCities()
	{
		return $this->arr;
	}
}