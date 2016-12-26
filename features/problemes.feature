Feature: Gérer les problème
  Pour créer une compétition
  En temps que organisateur
  Je dois pouvoir lire, ajouter, modifier & supprimer les problèmes

  Scenario: Lister les problèmes
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/problemes"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"