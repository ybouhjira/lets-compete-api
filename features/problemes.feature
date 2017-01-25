Feature: Gérer les problèmes
  Pour créer une compétition
  En temps que organisateur
  Je dois pouvoir lire, ajouter, modifier & supprimer les problèmes

  Scenario: Lister les problèmes
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/problemes"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to the schema "features/schemas/probleme/getall.json"

  Scenario: Lister les problèmes de la compétition 5
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "competitions/5/problemes"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"