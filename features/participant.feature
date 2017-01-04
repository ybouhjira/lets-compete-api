Feature: Gérer les participants

  Scenario: Lister tous les participants
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/participants"
    And print last JSON response
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"

  Scenario: Récuperer le participant ayant l'id 1
    When I send a "GET" request to "/participants/10"
    Then the response status code should be 200
    And the response should be in JSON
    And the response should contain "nom"
    And the response should contain "prenom"
    But the response should not contain "competitions"

  Scenario: Supprimer le participant ayant l'id 15
    When I send a "DELETE" request to "/participants/15"
    Then the response status code should be 204
    And the response should be empty
