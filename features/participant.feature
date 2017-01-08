Feature: Gérer les participants

  Scenario: Lister tous les participants
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/participants"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"

  Scenario: Récuperer le participant ayant l'id 10
    When I send a "GET" request to "/participants/10"
    Then the response status code should be 200
    And the response should be in JSON
    And the response should contain "nom"
    And the response should contain "prenom"
    But the response should not contain "competitions"

  Scenario: Supprimer le participant ayant l'id 15
    When I send a "DELETE" request to "/participants/15"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Créer un participant
    When I send a "POST" request to "/participants" with body:
    """
    {
      "prenom": "Kiara",
      "nom": "Ondricka",
      "email": "sdfmskfg@hotmail.com",
      "plainPassword": "helloWorld",
      "username": "dqfdsfsdf",
      "presentation": "Distinctio quos praesentium mollitia rem repellat impedit eos. Commodi et ex et et vel. Architecto perferendis eligendi rerum aut.",
      "telephone": "+1 (987) 86536-9125",
      "adresse": "578 Modesto Islands\nNew Erick, VT 40272",
      "ville": "/villes/42",
      "siteWeb": "hello.com"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
