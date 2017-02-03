Feature: Gérer les participations

  Scenario: Les toutes les participations
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/participations"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"