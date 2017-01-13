Feature: Gérer les solutions
  En temps que visiteur
  Je dois pouvoir visualiser les solutions

  Scenario: Lister les toutes les solutions
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/solutions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"

  Scenario: Lister les solutions de l'utilisateur 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "participants/10/solutions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
      {
        "properties" : {
          "hydra:membre": {
            "properties" : {
                "properties" : {
                  "@id": {"type" : "string"},
                  "fichier_codes": {
                    "type": "string",
                    "pattern": "^/solutions/\\d+/fichier_codes$"
                  },
                  "langage": {
                    "properties" : {
                      "@id": "/langages/2",
                      "nom": {"type" : "string"}
                    }
                  }
                }
            }
          }
        }

      }
    """

  Scenario: Récuperer la solution numéro 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/solutions/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
      {
        "properties" : {
          "@id": {"type" : "string"},
          "langage": {
            "properties" : {
              "@id": {"type" : "string"},
              "nom": {"type" : "string"}
            }
          }
        }
      }
    """