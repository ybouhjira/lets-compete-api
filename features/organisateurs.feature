Feature: Gérer les compétitions
  Pour gèrer les organisateurs
  En temps que administrateur
  Je dois pouvoir lire, ajouter, modifier & supprimer les organisateurs

  Scenario: Lister les organisateurs
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/organisateurs"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"