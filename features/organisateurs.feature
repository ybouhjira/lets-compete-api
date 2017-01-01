Feature: Gérer les organisateurs
  Pour gèrer les organisateurs
  En temps que administrateur
  Je dois pouvoir lire, ajouter, modifier & supprimer les organisateurs

  Scenario: Lister les organisateurs
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/organisateurs"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the response should contain "organisateur"

  Scenario: Récupérer l'organisateur ayant l'id 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/organisateurs/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the response should contain "ville"
    And the response should contain "adresse"
    And the response should contain "telephone"
    And the response should contain "cheminPhoto"

  Scenario: Supprimer l'organisateur ayant l'id 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/organisateurs/1"
    Then the response status code should be 204
    And the response should be empty