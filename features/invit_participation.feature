Feature: Gérer les invitations

  Scenario: Lister les invitations du participant 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/participants/10/invit_participations"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties": {
        "hydra:totalItems" : { "type" : "integer" },
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "@id" : { "type" : "string"},
              "@type" : { "type" : "string" },
              "competition" : {
                "properties": {
                   "titre": {"type" : "string"},
                   "@id": {"type" : "string"}
                }
              },
              "participant": {
                "properties" : {
                  "@id": { "type" : "string" },
                  "prenom": { "type" : "string" },
                  "nom": { "type" : "string" },
                  "email": { "type" : "string" }
                }
              }
            }
          }
        }
      }
    }
    """

  Scenario: Supprimer l'invitation ayant l'id 1
    And I send a "DELETE" request to "/invit_participations/1"
    Then the response status code should be 204
    And the response should be empty
    And I send a "GET" request to "/invit_participations/1"
    Then the response status code should be 404

  Scenario: Lister les invitations
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/invit_participations"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties": {
        "hydra:totalItems" : { "type" : "integer" },
        "hydra:member": {
          "type": "array",
          "items": {
            "properties" : {
              "@id" : { "type" : "string"},
              "@type" : { "type" : "string" },
              "competition" : {
                "properties": {
                   "titre": {"type" : "string"},
                   "@id": {"type" : "string"}
                }
              },
              "participant": {
                "properties" : {
                  "@id": { "type" : "string" },
                  "prenom": { "type" : "string" },
                  "nom": { "type" : "string" },
                  "email": { "type" : "string" }
                }
              }
            }
          }
        }
      }
    }
    """