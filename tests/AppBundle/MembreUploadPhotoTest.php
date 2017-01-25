<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;

$beforeContent = <<<_END
------WebKitFormBoundary7MA4YWxkTrZu0gW
Content-Disposition: form-data; name="photo"; filename="photo.jpg"
Content-Type: image/jpeg
_END;

class MembreUploadPhoto extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testUploadPhoto()
    {
        $id = 10;

        $this->envoie_requete_multipart_contenant_photo($id);
        $this->reponse_doit_etre_200();
        $this->requete_get_sur_le_membre($id);
        $this->reponse_doit_etre_200();
        $this->url_photo_doit_etre_correcte();
        $this->fichier_photo_doit_exister();
    }

    private function envoie_requete_multipart_contenant_photo($id)
    {
        global $beforeContent;
        $fileContent = fopen(__DIR__ . '/photo.jpg', 'r');
        $boundary = '----WebKitFormBoundary7MA4YWxkTrZu0gW';
        $content = $beforeContent . $fileContent . $boundary . '--';
        $headers = [
            'CONTENT_TYPE' =>
                'Content-Type: multipart/form-data; '.
                "boundary=$boundary"
        ];
        $url = "membres/$id/photo";
        $this->client->request('POST', $url, [], [], $headers, $content);
    }

    private function reponse_doit_etre_200()
    {
        $this->assertEquals(200 ,$this->client->getResponse()->getStatusCode());
    }

    private function requete_get_sur_le_membre($id)
    {
        $this->client->request('GET', "/membres/$id", [], [], [
            'HTTP_accept' => 'application/json'
        ]);
    }

    private function url_photo_doit_etre_correcte()
    {
        $data = json_decode($this->client->getResponse()->getContent());

        dump($data->cheminPhoto);
        die();
    }

    private function fichier_photo_doit_exister()
    {
        $data = json_decode($this->client->getResponse()->getContent());
        $this->fileExists(
            __DIR__ . "../../web/uploads/membres/photos/$data->cheminPhoto"
        );
    }
}