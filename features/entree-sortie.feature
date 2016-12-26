Feature: Gérer les entrée/sortie
  Afin de créer une compétition
  En temps que organisateur
  Je dois pouvoir lire, ajouter, modifier & supprimer les entrée/sortie

#  Scenario: Créer une entrée/sortie
#    When I add "Content-Type" header equal to "application/ld+json"
#    And I add "Accept" header equal to "application/ld+json"
#    And I send a "POST" request to "/entree_sorties" with body:
#    """
#    {
#      "entree": "Hello world!",
#      "sortie": "1 2 3 4",
#    }
#    """
#    Then the response status code should be 201
#    And the response should be in JSON
#    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
##    And the JSON should be equal to:
##    """
##    {
##      "@context": "/contexts/Book",
##      "@id": "/books/1",
##      "@type": "Book",
##      "entree": "Hello world!",
##      "sortie": "Persistence in PHP with the Doctrine ORM",
##    }
##    """

  Scenario: Lister les entrée/sortie
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/entree_sorties"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"