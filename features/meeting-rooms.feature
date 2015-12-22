Feature: Meeting Rooms
    This feature is testing the virtual-offices page of app.

    Scenario: Get meeting rooms index page.
        Given I am on the homepage
        When I go to "/meeting-rooms"
        Then I should see "LOCATIONS IN NORTH AMERICA"
        And the response status code should be 200


    Scenario: Get US state meeting rooms page.
        Given I am on the homepage
        When I go to "/meeting-rooms"
        When I follow "California"
        Then the url should match "/meeting-rooms/california"
        And the response status code should be 200
        And I should see "Home / Meeting Rooms / United States / California"

    Scenario: Get city meeting rooms index page.
        Given I am on the homepage
        When I go to "/meeting-rooms"
        When I follow "Los Angeles"
        Then the url should match "/meeting-rooms/US/los-angeles"
        And the response status code should be 200
        And I should see "Home / Meeting Rooms / United States / Los Angeles"

	Scenario: Book meeting room
	    Given I am on the homepage
	    When I send a POST request to "/meeting-rooms/book-meeting-room" with:
	      """json
	      {
	        "center_id" : "138",
	        "mr_id"      : "220",
	        "type"  : "mr",
	        "mr_date" : "12/22/2015",
	        "mr_start_time" : "3:00 PM",
	        "mr_end_time" :   "4:00 PM"
	      }
	      """
	    Then the response status code should be 200
	    And It should add temp_cart_item