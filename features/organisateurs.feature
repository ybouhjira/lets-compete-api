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
    And the JSON should be valid according to the schema "features/schemas/organisateurs/get.json"

  Scenario: Supprimer l'organisateur ayant l'id 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "DELETE" request to "/organisateurs/1"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Créer un organisateur
    When I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/organisateurs" with body:
    """
    {
      "username": "organisateur1234468",
      "plainPassword": "password",
      "presentation": "Bonjour je suis un organisateur",
      "telephone": "0654871269",
      "adresse": "Rue de l'organisateur ABCD",
      "ville": "/villes/1",
      "nom" : "Organis 123-ABC",
      "siteWeb": "organisateur-de-test-58469.com",
      "email": "org123@gmail.com"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the response should contain "Organis 123-ABC"
    And The file "test" exists in web folder "test"