Feature: Virtual Offices
    This feature is testing the virtual-offices page of app.

    Scenario: Get virtual offices index page.
        Given I am on the homepage
        When I go to "/virtual-offices"
        Then I should see "LOCATIONS IN NORTH AMERICA"
        And I should see "INTERNATIONAL LOCATIONS"
        And the response status code should be 200

    Scenario: Get country virtual offices page.
        Given I am on the homepage
        When I go to "/virtual-offices"
        When I follow "Belgium"
        Then the url should match "/virtual-offices/belgium"
        And the response status code should be 200
        And I should see "Home / Virtual Offices / Belgium"

    Scenario: Get US state virtual offices page.
        Given I am on the homepage
        When I go to "/virtual-offices"
        When I follow "California"
        Then the url should match "/virtual-offices/california"
        And the response status code should be 200
        And I should see "Home / Virtual Offices / United States / California"

    Scenario: Get city virtual office index page.
        Given I am on the homepage
        When I go to "/virtual-offices"
        When I follow "Los Angeles"
        Then the url should match "/virtual-offices/US/los-angeles"
        And the response status code should be 200
        And I should see "Home / Virtual Offices / United States / California / Los Angeles"

    Scenario: Book virtual office
        Given I am on the homepage
        When I send a POST request to "/sendcontact" with:
          """json
          {
            "center_id" : "134",
            "type"      : "vo",
            "package_option" : "105",
            "term"      : "6",
            "vo_mail_forwarding_package" : "20",
            "vo_mail_forwarding_frequency" : ""
          }
          """
        Then the response status code should be 200
        And It should add temp_cart_item
       
    Scenario: submit form
        Given I am on the homepage
        When I go to "/virtual-offices"
        When I follow "Los Angeles"
        When I follow "MORE INFORMATION"
        Then I should see "PLATINUM PLUS"
        When I go to "/customize-mail?p=105&cid=130"    
        Then I should see "STEP 1"
        When I fill in "term" with "6"
        When I fill in "vo_mail_forwarding_package" with "20"