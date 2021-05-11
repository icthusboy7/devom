@devotional @remove-devotional
Feature: Remove Devotional
  In order to remove Devotionals on the platform
  As a reader
  I want to remove a devotional

  Background:
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "d01ee3c1-1ea8-48c7-a835-081704729498",
      "title": "string",
      "passage": {
        "text": "string",
        "reference": "string"
      },
      "content": "string",
      "bibleReading": "string",
      "audioUrl": "http://google.com",
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
      "id": "d02ee3c1-1ea8-48c7-a835-081704729498",
      "title": "string",
      "passage": {
        "text": "string",
        "reference": "string"
      },
      "content": "string",
      "bibleReading": "string",
      "audioUrl": "http://google.com",
      "authorId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "publisherId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "topics": [
        "3fa85f64-5717-4562-b3fc-2c963f66afa6"
      ]
    }
    """
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "1048c3cf-d72a-40c5-afd4-7e250b5368f8",
        "year": 2060,
        "title": "plan 2060",
        "coverPhotoUrl": null
     }
    """
    Given I send a POST request to "/yearly-plans/1048c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "d01ee3c1-1ea8-48c7-a835-081704729498",
      "day": 1
    }
    """


  Scenario: Devotional in a plan
    When I send a DELETE request to "/devotionals/d01ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 409


  Scenario: Devotional without a plan
    When I send a DELETE request to "/devotionals/d02ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 204
    When I send a GET request to "/devotionals/d02ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 404

