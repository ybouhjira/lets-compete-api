Feature: Gérer les utilisateurs
  Pour gérer les utilisateurs
  En temps que admin
  Je dois pouvoir lire, ajouter, modifier & supprimer les utilisateurs

  Scenario: Lister les utilisateurs
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/utilisateurs"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"

  Scenario: Récuperer l'utilisateur ayant le username "foo"
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/utilisateurs?username=foo"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to the schema "features/schemas/utilisateurs/get.filter-username.json"
