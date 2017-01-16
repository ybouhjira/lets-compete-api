Feature: Gérer les compétitions
  Pour gérer les compétitions
  En temps que visiteur
  Je dois pouvoir lire, ajouter, modifier & supprimer les compétitions

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
  Scenario: Filtrer les compétitions par titre
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/competitions?titre=ad"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And print last JSON response
    And the JSON should be valid according to this schema:
    """
    {
      "properties" : {
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "titre": {
                "type": "string",
                "pattern": "[Aa][Dd]"
              }
            }
          }
        }
      }
    }
    """

  Scenario: Créer une compétition
    When I add "content-type" header equal to "application/json"
    And I send a "POST" request to "/competitions" with body:
    """
    {
      "langages": [
        "/langages/2",
        "/langages/3",
        "/langages/4"
      ],
      "titre": "Competition A aut.",
      "description": "Vel impedit vitae eum ut quod libero. Eaque etibus vel quibusdam harum cumque minima a.",
      "tempsDebut": "1997-12-14T02:04:36+01:00",
      "organisateur": "/organisateurs/7",
      "tempsFin": "1972-06-26T22:13:13+01:00",
      "public": true,
      "publie": false
    }
    """
    Then the response status code should be 201


  Scenario: Filtrer les compétitions par langages
    When I send a "GET" request to "/competitions?langages=1"
    Then the response status code should be 200
    And toutes les compétitions retournées contient le langage "1"

  Scenario: Filtrer les compétitions de l'oraganisateur 1
    When I send a "GET" request to "organisateurs/4/competitions?langages=1,2&publie=false&public=false&dateDebut[after]=now"
    Then the response status code should be 200
