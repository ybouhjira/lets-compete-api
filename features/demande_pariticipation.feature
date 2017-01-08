Feature: Gérer les demandes

  Scenario: Récupere la demande numéro 1
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/demande_participations/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "date": {"type" : "string"},
      "accepte" : {"type" : "boolean"},
      "competition": {
        "@id": {"type" : "string"},
        "titre": "Competition Mollitia doloremque."
      },
      "participant": {
        "@id": {"type" : "string"},
        "prenom": {"type" : "string"},
        "nom": {"type" : "string"}
      }
    }
    """

  Scenario: Supprimer la demande ayant l'id 1
    And I send a "DELETE" request to "/demande_participations/1"
    Then the response status code should be 204
    And the response should be empty
    And I send a "GET" request to "/demande_participations/1"
    Then the response status code should be 404

  Scenario: Lister les demandes
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/demande_participations"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be valid according to this schema:
    """
    {
      "properties": {
        "hydra:totalItems" : { "type" : "integer" },
        "hydra:member": {
          "date": {"type" : "string"},
          "accepte" : {"type" : "boolean"},
          "competition": {
            "@id": {"type" : "string"},
            "titre": "Competition Mollitia doloremque."
          },
          "participant": {
            "@id": {"type" : "string"},
            "prenom": {"type" : "string"},
            "nom": {"type" : "string"}
          }
        }
      }
    }
    """

  Scenario: Créer une demande
    When I add "content-type" header equal to "application/json"
    And I send a "POST" request to "/demande_participations" with body:
    """
    {
      "competition": "/competitions/81",
      "participant": "/participants/56"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON