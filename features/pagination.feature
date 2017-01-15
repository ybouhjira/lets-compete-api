Feature: Pagination

  Scenario: Récuperer une collection paginée sans préciser itemPerPage
    When I send a "GET" request to "/organisateurs/4/competitions"
    Then the JSON should be valid according to this schema:
    """
    {
      "required": ["hydra:member"],
      "properties": {
        "hydra:member": {
          "minItems": 10,
          "maxItems": 10
        }
      }
    }
    """