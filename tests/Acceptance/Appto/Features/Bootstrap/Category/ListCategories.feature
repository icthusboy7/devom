@category @list-category
Feature: List category
  In order to list categories on the platform
  As a reader
  I want to see the category list

  Background:
    Given I send a POST request to "/categories" with body:
    """
    {
      "id": "ca015589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "description": "string",
      "position": 1
    }
    """
    Given I send a POST request to "/categories" with body:
    """
    {
      "id": "ca025589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "description": "string",
      "position": 1
    }
    """
  Scenario: A valid list of categories
    When I send a GET request to "/categories"
    Then the response status code should be 200
#    And the response content length should be 2
