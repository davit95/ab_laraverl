Feature: Live Receptionist
    This feature is testing the live-receptionist page of app.

    Scenario: Add live-receptionist to cart.
    	Given I am on the homepage
        When I send a POST request to "/live-receptionist-add-to-cart" with:
          """json
          {
            "lr_id" : "402",
            "lr_name"      : "Virtual Office Live Receptionist 50",
            "price"  : "95"
          }
          """
        Then the response status code should be 200
        And It should add temp_cart_item        