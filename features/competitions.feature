Feature: Gérer les compétitions
  Pour gérer les compétitions
  En temps que visiteur
  Je dois pouvoir lire, ajouter, modifier & supprimer les compétitions

  @createSchema
  Scenario: Lister les compétitions
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to the schema "features/schemas/competitions/getall.json"

  Scenario: Supprimer une compétition
    When I send a "DELETE" request to "/competitions/5"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Récuperer les compétitions de l'organisateur ayant l'id 2
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "organisateurs/2/competitions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the response should contain "tempsDebut"
    And the response should contain "tempsFin"
    And the JSON should be valid according to the schema "features/schemas/competitions/get.json"

  Scenario: Récuperer les compétitions privées seulement
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions?public=false"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties" : {
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "public": {"constant": false}
            }
          }
        }
      }
    }
    """

  Scenario: Récuperer les compétitions publiques seulement
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions?public=true"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties" : {
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "public": {"constant": true}
            }
          }
        }
      }
    }
    """

  Scenario: Récuperer les compétitions publiées seulement
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions?publie=true"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties" : {
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "publie": {"constant": true}
            }
          }
        }
      }
    }
    """

  Scenario: Récuperer les compétitions non publiées seulement
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions?publie=false"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties" : {
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "publie": {"constant": false}
            }
          }
        }
      }
    }
    """