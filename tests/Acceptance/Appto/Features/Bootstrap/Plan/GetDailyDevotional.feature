@plan @get-daily-devotional
Feature: Get Daily Devotional
  In order to get Daily Devotional on the platform
  As a reader
  I want to get Daily devotional

  Background:
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "eaf51dbd-3bee-4f11-8c6e-725d6b007fb4",
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
        "id": "177ba35f-535f-4372-9884-fa9629893513",
        "year": 2050,
        "title": "plan 2050",
        "coverPhotoUrl": null
     }
    """


  Scenario: A non existing Daily Devotional
    When I send a "GET" request to "/yearly-plans/177ba35f-535f-4372-9884-fa9629893513/devotionals/eaf51dbd-3bee-4f11-8c6e-725d6b007fb4"
    Then the response status code should be 404


  Scenario: An existing Daily Devotional
    When I send a POST request to "/yearly-plans/177ba35f-535f-4372-9884-fa9629893513/devotionals" with body:
    """
    {
      "devotionalId": "eaf51dbd-3bee-4f11-8c6e-725d6b007fb4",
      "day": 1
    }
    """
    When I send a GET request to "/yearly-plans/177ba35f-535f-4372-9884-fa9629893513/devotionals/eaf51dbd-3bee-4f11-8c6e-725d6b007fb4"
    Then the response content should be:
    """
    {
        "devotional": {
            "id": "eaf51dbd-3bee-4f11-8c6e-725d6b007fb4",
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


  Scenario: From a not existing Plan
    When I send a "GET" request to "/yearly-plans/4cf7834a-43d5-4edc-b8ba-ada942dc673d/devotionals/eaf51dbd-3bee-4f11-8c6e-725d6b007fb4"
    Then the response status code should be 404