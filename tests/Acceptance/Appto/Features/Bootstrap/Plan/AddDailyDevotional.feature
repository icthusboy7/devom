@plan @add-daily-devotional
Feature: Add Daily Devotional
  In order to add Daily Devotionals on the platform
  As a reader
  I want to see the Yearly Devotionals ordered descendant by Day

  Background:
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "d90ee3c1-1ea8-48c7-a835-081704729498",
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
      ],
      "status": 0
    }
    """
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "65b6bb4f-856b-42d9-8cf1-c9d27c5d6961",
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
      ],
      "status": 0
    }
    """
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "9d48c3cf-d72a-40c5-afd4-7e250b5368f8",
        "year": 2060,
        "title": "plan 2060",
        "coverPhotoUrl": null
     }
    """


  Scenario: A non existing Devotional
    When I send a POST request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "d00ee3c1-1ea8-48c7-a835-081704729498",
      "day": 1
    }
    """
    Then the response status code should be 404


  Scenario: An existing Devotional
    When I send a POST request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "d90ee3c1-1ea8-48c7-a835-081704729498",
      "day": 1
    }
    """
    Then the response status code should be 201
    When I send a GET request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals/d90ee3c1-1ea8-48c7-a835-081704729498"
    Then the response content should be:
    """
    {
        "devotional": {
            "id": "d90ee3c1-1ea8-48c7-a835-081704729498",
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
            ],
            "status": 100
        },
        "day": 1
    }
    """


  Scenario: An existing Daily Devotional, Conflicts when the devotional already exists
    When I send a POST request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "d90ee3c1-1ea8-48c7-a835-081704729498",
      "day": 2
    }
    """
    Then the response status code should be 409


  Scenario: An existing Daily Devotional, Conflicts when there is a devotional in this day
    When I send a POST request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "65b6bb4f-856b-42d9-8cf1-c9d27c5d6961",
      "day": 1
    }
    """
    Then the response status code should be 409


  Scenario: A non next Daily Devotional, Conflicts when the day is not the next day
    When I send a POST request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "65b6bb4f-856b-42d9-8cf1-c9d27c5d6961",
      "day": 3
    }
    """
    Then the response status code should be 409


  Scenario: An invalid YearlyDay
    When I send a POST request to "/yearly-plans/9d48c3cf-d72a-40c5-afd4-7e250b5368f8/devotionals" with body:
    """
    {
      "devotionalId": "65b6bb4f-856b-42d9-8cf1-c9d27c5d6961",
      "day": 367
    }
    """
    Then the response status code should be 400


  Scenario: A non existing plan
    When I send a POST request to "/yearly-plans/e2aba724-ab76-4cc1-ae9b-71ca39abb27f/devotionals" with body:
    """
    {
      "devotionalId": "65b6bb4f-856b-42d9-8cf1-c9d27c5d6961",
      "day": 1
    }
    """
    Then the response status code should be 404