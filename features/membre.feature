Feature: Changer la photo de profil
  En temps que membre
  Je dois pouvoir changer ma photo de profil

  Scenario: Lister les memebres
    When I send a "GET" request to "/membres"
    Then the response status code should be 200
    And print last JSON response
