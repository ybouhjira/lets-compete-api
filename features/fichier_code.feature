Feature: Gérer les fichier de code

  Scenario: Lister les toutes fichier de code
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/fichier_codes"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"