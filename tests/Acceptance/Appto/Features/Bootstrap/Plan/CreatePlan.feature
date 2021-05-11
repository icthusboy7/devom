@plan @create-plan
Feature: Create a new yearly plan
  In order to have yearlyplans on the platform
  As a Publisher
  I want to create a new yearly plan

  Scenario: A valid non existing yearly plan
    Given I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "4c0616e6-cae3-42d1-aa43-d3606b70d9b8",
        "year": 2025,
        "title": "plan 2025",
        "coverPhotoUrl": null
     }
    """
    Then the response status code should be 201
    And the response should be empty
    When I send a "GET" request to "/yearly-plans/4c0616e6-cae3-42d1-aa43-d3606b70d9b8"
    Then the response status code should be 200
    And the response content should be:
    """
    {
        "id": "4c0616e6-cae3-42d1-aa43-d3606b70d9b8",
        "year": 2025,
        "title": "plan 2025",
        "coverPhotoUrl": null
    }
    """


  Scenario: A valid existing Yearly Plan, Conflict with duplicated id
    When I send a POST request to "/yearly-plans" with body:
    """
    {
        "id": "4c0616e6-cae3-42d1-aa43-d3606b70d9b8",
        "year": 2025,
        "title": "plan 2025",
        "coverPhotoUrl": null
     }
    """
    Then the response status code should be 409


#  Scenario Outline: An invalid Yearly Plan
#    When I send a POST request to "/yearly-plans" with body:
#    """
#    {
#        "id": <id>,
#        "year": <year>,
#        "title": <title>,
#        "coverPhotoUrl": <cover_photo_url>
#     }
#    """
#    Then the response status code should be 400
#    Examples:
#      | id                                    | year    | title        | cover_photo_url      |
#      | 0                                     | 2020    | "plan title" | "http://domain.com"  |
#      | true                                  | 2020    | "plan title" | "http://domain.com"  |
#      | null                                  | 2020    | "plan title" | "http://domain.com"  |
#      | ""                                    | 2020    | "plan title" | "http://domain.com"  |
#      |                                       | 2020    | "plan title" | "http://domain.com"  |
#      | "01ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| null    | "plan title" | "http://domain.com"  |
#      | "02ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 0       | "plan title" | "http://domain.com"  |
#      | "03ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| false   | "plan title" | "http://domain.com"  |
#      | "04ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| true    | "plan title" | "http://domain.com"  |
#      | "05ee1f66-a940-4ff6-ad54-45cf09fe6a2b"|         | "plan title" | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "text"  | "plan title" | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    |              | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | ""           | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | null         | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | 0            | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | 9.99         | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | false        | "http://domain.com"  |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" |                      |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | null                 |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | 0                    |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | false                |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | "text"               |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | "http://domain"      |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | "http://.com"        |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2020    | "plan title" | "domain.com"         |