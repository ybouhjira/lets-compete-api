Feature: Gérer les entrée/sortie
  Afin de créer une compétition
  En temps que organisateur
  Je dois pouvoir lire, ajouter, modifier & supprimer les entrée/sortie

  Scenario: Créer une entrée/sortie
    When I add "Content-Type" header equal to "application/ld+json"
    And I add "Accept" header equal to "application/ld+json"
    And I send a "POST" request to "/entree_sorties" with body:
    """
    {
      "entree": "test",
      "sortie": "test",
      "type": "/type_entree_sorties/1"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"

  Scenario: Lister les entrée/sortie
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/entree_sorties"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
