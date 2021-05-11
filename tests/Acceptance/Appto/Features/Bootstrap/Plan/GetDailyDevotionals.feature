@plan @get-daily-devotionals
Feature: Get Daily Devotionals
  In order to get Daily Devotionals on the platform
  As a reader
  I want to see the Yearly Devotionals ordered descendant by Day

  Background:
    Given I send a POST request to "/devotionals" with body:
    """
    {
      "id": "c8c15ec7-daa0-4b81-86a0-66d0c38284fc",
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
      "id": "a7cf2372-4282-4687-bded-f7940d15f672",
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
        "id": "5a5e382a-f29b-4538-9bb1-62f22f5c7e17",
        "year": 2030,
        "title": "plan 2030",
        "coverPhotoUrl": null
     }
    """

  Scenario: From an empty Plan
    When I send a "GET" request to "/yearly-plans/5a5e382a-f29b-4538-9bb1-62f22f5c7e17/devotionals"
    Then the response content should be:
    """
      []
    """

  Scenario: From a Plan with Devotionals
    When I send a POST request to "/yearly-plans/5a5e382a-f29b-4538-9bb1-62f22f5c7e17/devotionals" with body:
    """
    {
      "devotionalId": "c8c15ec7-daa0-4b81-86a0-66d0c38284fc",
      "day": 1
    }
    """
    When I send a POST request to "/yearly-plans/5a5e382a-f29b-4538-9bb1-62f22f5c7e17/devotionals" with body:
    """
    {
      "devotionalId": "a7cf2372-4282-4687-bded-f7940d15f672",
      "day": 2
    }
    """
    When I send a "GET" request to "/yearly-plans/5a5e382a-f29b-4538-9bb1-62f22f5c7e17/devotionals"
    Then the response status code should be 200
    And the response content should be:
    """
    [
        {
            "devotional": {
                "id": "a7cf2372-4282-4687-bded-f7940d15f672",
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
            "day": 2
        },
        {
            "devotional": {
                "id": "c8c15ec7-daa0-4b81-86a0-66d0c38284fc",
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
    ]
    """    

  Scenario: From a not existing Plan
    When I send a "GET" request to "/yearly-plans/a3700e00-9104-45e2-9d5e-df0f2dbceaee/devotionals"
    Then the response status code should be 404
