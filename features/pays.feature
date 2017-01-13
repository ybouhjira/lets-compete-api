Feature: Gérer les pays
  Afin de créer un profils
  En temps que visiteur
  Je dois pouvoir lire, ajouter les pays

  Scenario: Lister les pays
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/pays"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to the schema "features/schemas/pays/getall.json"