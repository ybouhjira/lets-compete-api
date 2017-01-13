Feature: Gérer les villes
  Afin de créer un profils
  En temps que visiteur
  Je dois pouvoir lire, ajouter les villes

  Scenario: Lister les villes
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/villes"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"

  Scenario: Lister les villes du pays 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/pays/1/villes"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to the schema "features/schemas/villes/getall.json"