@plan @get-yearly-plan
Feature: Get YearlyPlan
  In order to get YearlyPlan on the platform
  As a reader
  I want to get YearlyPlan

  Scenario: From a not existing YearlyPlan
    When I send a "GET" request to "/yearly-plans/a3700e00-9104-45e2-9d5e-df0f2dbceaee"
    Then the response status code should be 404