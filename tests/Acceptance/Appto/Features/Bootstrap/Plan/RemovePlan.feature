@plan @remove-plan
Feature: Remove a yearly plan
  In order to remove a yearlyplan on the platform
  As a Publisher
  I want to remove a yearly plan

  Background:
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "aac62f38-46b8-43f2-9526-f0a757275488",
        "year": 2080,
        "title": "plan 2080",
        "coverPhotoUrl": null
     }
    """
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "bbc62f38-46b8-43f2-9526-f0a757275488",
        "year": 2080,
        "title": "plan 2080",
        "coverPhotoUrl": null
     }
    """

  Scenario: An existing empty YearlyPlan
    When I send a DELETE request to "/yearly-plans/aac62f38-46b8-43f2-9526-f0a757275488"
    Then the response status code should be 204
    When I send a GET request to "/yearly-plans/aac62f38-46b8-43f2-9526-f0a757275488"
    Then the response status code should be 404


  Scenario: An existing YearlyPlan with devotionals
    When I send a POST request to "/yearly-plans/bbc62f38-46b8-43f2-9526-f0a757275488/devotionals" with body:
    """
    {
      "devotionalId": "d90ee3c1-1ea8-48c7-a835-081704729498",
      "day": 1
    }
    """
    When I send a DELETE request to "/yearly-plans/bbc62f38-46b8-43f2-9526-f0a757275488"
    Then the response status code should be 204
    When I send a GET request to "/yearly-plans/bbc62f38-46b8-43f2-9526-f0a757275488"
    Then the response status code should be 404