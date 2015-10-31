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
