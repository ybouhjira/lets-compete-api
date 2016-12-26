Feature: Gérer les compétitions
  Pour gérer les compétitions
  En temps que visiteur
  Je dois pouvoir lire, ajouter, modifier & supprimer les compétitions

  @createSchema
  Scenario: Lister les compétitions
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"