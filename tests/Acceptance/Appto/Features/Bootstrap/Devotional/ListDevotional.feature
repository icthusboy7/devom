@plan @list-devotionals
Feature: List devotionals
  In order to list devotionals on the platform
  As a reader
  I want to list devotionals

  Background:
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "01735589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "passage": {
        "text": "string",
        "reference": "string"
      },
      "content": "string",
      "bibleReading": "string",
      "audioUrl": "http://apto.dev",
      "authorId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "publisherId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "topics": [
        "3fa85f64-5717-4562-b3fc-2c963f66afa6"
      ]
    }
    """
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "02735589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "passage": {
        "text": "string",
        "reference": "string"
      },
      "content": "string",
      "bibleReading": "string",
      "audioUrl": "http://apto.dev",
      "authorId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "publisherId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "topics": [
        "3fa85f64-5717-4562-b3fc-2c963f66afa6"
      ]
    }
    """
  Scenario: A valid devotional list
    When I send a GET request to "/devotionals"
    Then the response status code should be 200
#    And the response content length should be 2
