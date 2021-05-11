@category @create-category
Feature: Create a new Category
  In order to have categories on the platform
  As a Publisher
  I want to create a new category

  Scenario: A valid non existing category
    When I send a POST request to "/categories" with body:
    """
    {
      "id": "ca015589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "description": "string",
      "position": 1
    }
    """
    Then the response status code should be 201
    And the response should be empty
    When I send a "GET" request to "/categories/ca015589-e799-458c-af99-27b38d97b458"
    Then the response status code should be 200
    And the response content should be:
    """
    {
      "id": "ca015589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "description": "string",
      "position": 1
    }
    """


  Scenario: A valid existing Category, Conflict with duplicated id
    When I send a POST request to "/categories" with body:
    """
    {
      "id": "ca015589-e799-458c-af99-27b38d97b458",
      "title": "string",
      "description": "string",
      "position": 1
    }
    """
    Then the response status code should be 409


#  Scenario Outline: An invalid Category
#    When I send a POST request to "/categories" with body:
#    """
#    {
#      "id": <id>,
#      "title": <title>,
#      "description": <description>,
#      "position": <position>
#    }
#    """
#    Then the response status code should be 400
#    Examples:
#      | id                                    | title   | description           | position |
#      | 0                                     | "title" | "short description"   |  1       |
#      | true                                  | "title" | "short description"   |  1       |
#      | null                                  | "title" | "short description"   |  1       |
#      | ""                                    | "title" | "short description"   |  1       |
#      |                                       | "title" | "short description"   |  1       |
#      | "01ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| null    | "short description"   |  1       |
#      | "02ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| 2.79    | "short description"   |  1       |
#      | "03ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| false   | "short description"   |  1       |
#      | "04ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| true    | "short description"   |  1       |
#      | "05ee1f66-a940-4ff6-ad54-45cf09fe6a2b"|         | "short description"   |  1       |
#      | "06ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "short description"   |  1       |
#      | "07ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "short description"   |  1       |
#      | "08ee1f66-a940-4ff6-ad54-45cf09fe6a2b"| "title" | "short description"   |  1       |
