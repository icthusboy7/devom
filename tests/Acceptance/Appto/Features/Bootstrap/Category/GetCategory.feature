@category @get-category
Feature: Get category
  In order to get category on the platform
  As a reader
  I want to see category

  Scenario: From a not existing category
    When I send a "GET" request to "/categories/a3700e00-9104-45e2-9d5e-df0f2dbceaee"
    Then the response status code should be 404