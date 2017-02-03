Feature: Sous resources

  Scenario: Récuperer les compétitions de l'organisateur 4
    When I send a "GET" request to "/organisateurs/4/competitions"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/has-pagination.json"
    And the JSON should be valid according to this schema:
    """
    {
      "properties": {
        "hydra:totalItems": {
          "constant": 115
        }
      }
    }
    """

  Scenario: Récuperer les solutions d'un participant
    When I send a "GET" request to "/participants/15"
    Then the response status code should be 200
    When I send a "GET" request to "/participants/15/solutions"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/list.json"

  Scenario: Récuperer les invitations d'un participant
    When I send a "GET" request to "/participants/15"
    Then the response status code should be 200
    When I send a "GET" request to "/participants/15/invit_participations"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/list.json"

  Scenario: Récuperer les invitations d'un participant
    When I send a "GET" request to "/participants/15"
    Then the response status code should be 200
    When I send a "GET" request to "/participants/15/invit_participations"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/list.json"

  Scenario: Récuperer les demandes d'un participant
    When I send a "GET" request to "/participants/15"
    Then the response status code should be 200
    When I send a "GET" request to "/participants/15/demande_participations"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/list.json"

  Scenario: Récuperer les compétitions d'un organisateur
    When I send a "GET" request to "/organisateurs/5"
    Then the response status code should be 200
    When I send a "GET" request to "/organisateurs/5/competitions"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/list.json"

  Scenario: Faire une requête GET sur les compétitions d'un organisateur qui en a aucune
    When I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/organisateurs" with body:
    """
    {
      "username": "org16585",
      "plainPassword": "password",
      "presentation": "Bonjour je suis un organisateur",
      "telephone": "06597462644",
      "adresse": "Rue de l'organisateur ABCD",
      "ville": "/villes/1",
      "nom" : "Organis DFLNDFOI",
      "siteWeb": "organisateur-azgkjsdg.com",
      "email": "org1239746@gmail.com"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the response should contain "Organis DFLNDFOI"
    And The file "test" exists in web folder "test"
    And I do a GET request on on his "competitions"
    Then the response status code should be 200

  Scenario: Récuperer les compétitions d'un langage
    When I send a "GET" request to "/langages/2"
    Then print last JSON response
    And the JSON should be valid according to this schema:
    """
    {
      "required": ["competitions"],
      "properties": {
        "competitions": {
          "constant": "langages/2/competitions"
        }
      }
    }
    """
    When I send a "GET" request to "/langages/2/competitions"
    And the response status code should be 200
    And the response should be in JSON
    And the JSON should be valid according to the schema "features/schemas/list.json"