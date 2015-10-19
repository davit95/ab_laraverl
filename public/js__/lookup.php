<?php
include '../siteFunctions.php';
//include "../db_connect.inc";

$locations = array();
$number_of_results = '0';
$_REQUEST['q'] = addslashes($_REQUEST['q']);

// search for cities first
$query = mysql_query("SELECT DISTINCT extras.Full_City, extras.Full_Country, extras.Full_State, country.Code from Center_Extras as extras, Country as country where extras.Full_City LIKE '$_REQUEST[q]%' and extras.Full_Country = country.Name ORDER BY extras.Full_City") or die("Error rr: " . mysql_error());
while( $data = mysql_fetch_array($query) )
{
	if( $data['Code'] == 'US' )
	{
		$state_q = mysql_query("SELECT Abbrv from States where Name = '$data[Full_State]'") or die("Error rr: " . mysql_error());
		$state_d = mysql_fetch_array($state_q);
		if( $data[Full_City] != 'Newark' )
		{
		echo <<<END
$data[Full_City], $state_d[Abbrv]

END;
		}
	}
	else
	{

		echo <<<END
$data[Full_City], $data[Code]

END;

	}
}


//zip code query
$zip_q = mysql_query("SELECT DISTINCT City, State, Country, PostalCode from Center where PostalCode LIKE '$_REQUEST[q]%' AND ActiveFlag = 'Y' ORDER BY City") or die("Error 553: " . mysql_error());
while( $zip_d = mysql_fetch_array($zip_q) )
{
	if( $zip_d['Country'] == 'US' )
	{
		echo <<<END
$zip_d[PostalCode] ($zip_d[City], $zip_d[State])

END;
	}
	else
	{
		echo <<<END
$zip_d[PostalCode] ($zip_d[City], $zip_d[Country])

END;
	}
}

// state query
$state_q = mysql_query("SELECT DISTINCT Name from States where Name LIKE '$_REQUEST[q]%' order by Name");
while( $state_d = mysql_fetch_array($state_q) )
{
	echo <<<END
$state_d[Name]

END;
}

// country query
$country_q = mysql_query("SELECT DISTINCT Name, Code from Country WHERE Name LIKE '$_REQUEST[q]%' OR Code LIKE '$_REQUEST[q]%' order by Name");
while( $country_d = mysql_fetch_array($country_q) )
{
	$country_d['Name'] = ucfirst(strtolower($country_d['Name']));
	echo <<<END
$country_d[Name]

END;
}

?>
