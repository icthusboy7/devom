@plan @get-devotional
Feature: Get Devotional
  In order to get devotional on the platform
  As a reader
  I want to see devotional

  Scenario: From a not existing Devotional
    When I send a "GET" request to "/devotionals/a3700e00-9104-45e2-9d5e-df0f2dbceaee"
    Then the response status code should be 404