Feature: Gérer les compétitions

  Scenario: Lister les compétitions
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
    And print last JSON response