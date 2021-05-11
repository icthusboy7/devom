@devotional @create-devotional
Feature: Create a new Devotional
  In order to have devotionals on the platform
  As a Publisher
  I want to create a new devotional

  Scenario: A valid non existing devotional
    When I send a POST request to "/devotionals" with body:
    """
    {
      "id": "07735589-e799-458c-af99-27b38d97b458",
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
      ],
      "status": 0
    }
    """
    Then the response status code should be 201
    And the response should be empty
    When I send a "GET" request to "/devotionals/07735589-e799-458c-af99-27b38d97b458"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "07735589-e799-458c-af99-27b38d97b458",
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
      ],
      "status": 100
    }
    """

  Scenario: A valid existing Devotional, Conflict with duplicated id
    When I send a POST request to "/devotionals" with body:
    """
    {
      "id": "07735589-e799-458c-af99-27b38d97b458",
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
      ],
      "status": 100
    }
    """
    Then the response status code should be 409


  Scenario Outline: An invalid Devotional
    When I send a POST request to "/devotionals" with body:
    """
    {
      "id": <id>,
      "title": <title>,
      "passage": {
          "text": <passage_text>,
          "reference": <passage_reference>
      },
      "content": <content>,
      "bibleReading": <bible_reading>,
      "audioUrl": <audio_url>,
      "authorId": <author_id>,
      "publisherId": <publisher_id>,
      "topics": <topics>
    }
    """
    Then the response status code should be 400
    Examples:
      | id                                    | title   | passage_text | passage_reference | content | bible_reading | audio_url | author_id                              | publisher_id                           | topics  |
      | 0                                     | "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | true                                  | "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | null                                  | "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | ""                                    | "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      |                                       | "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | "01ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| null    | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | "02ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2.79    | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | "03ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| false   | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | "04ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| true    | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | "05ee1f66-a940-4ff6-ad54-45cf09fe6a2b"|         | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | []      |
      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" |         |
      | "07ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | true    |
      | "08ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" | 10      |
      | "09ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "passage"    | "reference"       | "...."  | null          | null      | "bd1a1c79-1cb4-47fd-8909-f94f4a48965f" | "cd31d6e5-4b7d-4051-8e9a-1ef9e56e32c6" |         |
