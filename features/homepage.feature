Feature: Homepage
    This feature is testing the home page of app.

    Scenario: Get homepage.
        When I go to homepage
        Then I should see "LOOKING FOR A 21st CENTURY SOLUTION FOR YOUR NEXT OFFICE?"
        And I should see "Get a smart, affordable workplace solution today."
        And the response status code should be 200

    Scenario: Open virtual-offices page.
        Given I am on homepage
        When I follow "VIRTUAL OFFICES"
        Then the url should match "/virtual-offices"
        And the response status code should be 200

    Scenario: Open meeting-rooms page.
        When I go to homepage
        When I follow "MEETING ROOMS"
        Then the url should match "/meeting-rooms"
        And the response status code should be 200

    Scenario: Open live-receptionist page.
        When I go to homepage
        When I follow "LIVE RECEPTIONISTS"
        Then the url should match "/live-receptionist"
        And the response status code should be 200

    Scenario: Open login page.
        When I go to homepage
        When I follow "Login"
        Then the url should match "/login"
        And the response status code should be 200

    Scenario: Open contact page.
        When I go to homepage
        When I follow "Contact"
        Then the url should match "/contact"
        And the response status code should be 200

    Scenario: Open cart page.
        When I go to homepage
        When I follow "CART"
        Then the url should match "/cart"
        And the response status code should be 200
