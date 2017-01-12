Feature: Entrée de l'api
  En temps que client
  Je veux connaitre les resources disponibles
  pour faire des requêtes

  Scenario: GET sur /
    When I send a "GET" request to "/"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to the schema "features/schemas/entrypoint.json"
