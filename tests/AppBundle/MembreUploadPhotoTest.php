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
        $this->whenIsendARequestContainingThePhoto();
        $this->thenTheResponseShouldBeOK();
    }

    private function whenIsendARequestContainingThePhoto()
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
        $url = 'membres/10/photo';
        $this->client->request('POST', $url, [], [], $headers, $content);
    }

    private function thenTheResponseShouldBeOK()
    {
        $this->assertEquals(200 ,$this->client->getResponse()->getStatusCode());
    }
}