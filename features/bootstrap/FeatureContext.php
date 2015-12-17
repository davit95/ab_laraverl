<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;

use GuzzleHttp\Psr7\Request as GRequest;
use GuzzleHttp\Client;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{	
	public function __construct()
	{
		$this->jar = new GuzzleHttp\Cookie\CookieJar();
		$this->client = new Client([
        	'base_url' => ['http://abcn.dev', ['version' => 'v1.1', 'cookies' => $this->jar]],
    	]);
	}
	

	/**
	* @When /^I send a ([A-Z]+) request to "([^"]*)" with:/
	*/
	public function iSendARequestToWith($method, $uri, PyStringNode $pystring)
	{
	  $params = (array)json_decode(implode($pystring->getStrings()));
	  // $uri = $this->filter_uri($uri);

	  if( isset( $params["file_path"] ) ){
	      $params['path'] = public_path().$params['file_path'];
	      $request = $this->client->createRequest($method, $uri, [
	        'cookies'         => $this->jar,
	        'body'            => [ 
	            $params , 
	            $params['file_name'] => fopen( public_path().$params['file_path'] , 'r'),               
	        ]
	      ]);         
	  }else{
	      $request = $this->client->createRequest($method, $uri, [
	        'cookies'         => $this->jar,
	        'body'            => $params
	      ]);        
	  }

	  $this->responseString = "";
	  $this->response = $this->client->send($request);
	  $body = $this->response->getBody();
	  while (!$body->eof()) {
	      $this->responseString .= $body->read(1024);
	  }
	}

	/**
	 * @Given /^the JSON response should have a "([^"]*)" containing "([^"]*)"$/
	 */
	public function theJsonResponseShouldHaveAContaining($var_name, $var_contain_val)
	{
	  $decoded_json = json_decode($this->responseString, true);
	  $responseStatus = $decoded_json[$var_name];
	  PHPUnit_Framework_Assert::assertEquals($responseStatus, $var_contain_val);
	}
	
	// private function filter_uri($uri) {
	//   // var_dump($this->insert_id);
	//   return str_replace('{insert_id}', $this->insert_id, $uri);
	// }
}
