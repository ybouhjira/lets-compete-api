<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test de la récupération du token JWT
 */
class JWTAuthTest extends WebTestCase
{
    public function test_auth_endpoint_returns_token()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check', [
                '_username' => 'jwttest', // from fixtures
                '_password' => 'password',
            ]
        );

        $res = $client->getResponse();
        $c = $res->getContent();
        $data = json_decode($res->getContent());

        $this->assertEquals(200, $res->getStatusCode(), $c);
        $this->assertObjectHasAttribute("token", $data, $c);
        $this->assertObjectHasAttribute("utilisateur", $data, $c);
    }
}