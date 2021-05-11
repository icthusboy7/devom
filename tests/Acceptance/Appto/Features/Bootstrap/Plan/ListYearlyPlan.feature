@plan @list-yearly-plans
Feature: List YearlyPlan
  In order to list YearlyPlans on the platform
  As a reader
  I want to list YearlyPlans

  Background:
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "821665f1-ab0e-419c-9037-eb73bd4823cc",
        "year": 2070,
        "title": "plan 2070",
        "coverPhotoUrl": null
     }
    """
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "7f30ed42-367b-46eb-acfd-bee455ad8cfc",
        "year": 2071,
        "title": "plan 2071",
        "coverPhotoUrl": null
     }
    """
  Scenario: A valid List YearlyPlans
    When I send a GET request to "/yearly-plans"
    Then the response status code should be 200
    And the response content should be:
    """
    [
      {
          "id": "821665f1-ab0e-419c-9037-eb73bd4823cc",
          "year": 2070,
          "title": "plan 2070",
          "coverPhotoUrl": null
      },
      {
          "id": "7f30ed42-367b-46eb-acfd-bee455ad8cfc",
          "year": 2071,
          "title": "plan 2071",
          "coverPhotoUrl": null
      }
    ]
    """