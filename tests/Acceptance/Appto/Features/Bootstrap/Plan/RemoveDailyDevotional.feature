@plan @remove-daily-devotional
Feature: Remove Daily Devotional
  In order to remove Daily Devotionals on the platform
  As a reader
  I want to remove a daily devotional

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
    Given I send a POST request to "/yearly-plans/1048c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "d02ee3c1-1ea8-48c7-a835-081704729498",
      "day": 2
    }
    """


  Scenario: A non last Daily Devotional
    When I send a DELETE request to "/yearly-plans/1048c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals/d01ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 409


  Scenario: A last Daily Devotional
    When I send a DELETE request to "/yearly-plans/1048c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals/d02ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 204
    When I send a GET request to "/yearly-plans/1048c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals/d02ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 404


  Scenario: A non existing Daily Devotional
    When I send a DELETE request to "/yearly-plans/1048c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals/0e0ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 404


  Scenario: A non existing plan
    When I send a DELETE request to "/yearly-plans/0d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals/d01ee3c1-1ea8-48c7-a835-081704729498"
    Then the response status code should be 404