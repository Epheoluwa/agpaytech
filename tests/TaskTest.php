<?php
// require 'vendor/autoload.php';
class TaskTest extends \PHPUnit\Framework\TestCase
{
    private $http;
    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/agpaytech/']);
    }

    public function tearDown(): void {
        $this->http = null;
    }

    public function testGetCurrency()
    {
        $response = $this->http->request('GET', 'api/Fetch.php');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('iso_code', $data[0]);
        $this->assertArrayHasKey('iso_numeric_code', $data[0]);
        $this->assertArrayHasKey('common_name', $data[0]);
        $this->assertArrayHasKey('official_name', $data[0]);
        $this->assertArrayHasKey('symbol', $data[0]);
        $this->assertEquals(1, $data["page"]);
        $this->assertEquals(16, $data["Totalpage"]);

    }

    public function testSearchCurrency(){
        $response = $this->http->request('GET', 'api/Fetch.php?search=British pound');
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('iso_code', $data[0]);
        $this->assertArrayHasKey('iso_numeric_code', $data[0]);
        $this->assertArrayHasKey('common_name', $data[0]);
        $this->assertArrayHasKey('official_name', $data[0]);
        $this->assertArrayHasKey('symbol', $data[0]);
    }

    public function testPaginationCurrency(){
        $response = $this->http->request('GET', 'api/Fetch.php?page=10');
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('iso_code', $data[0]);
        $this->assertArrayHasKey('iso_numeric_code', $data[0]);
        $this->assertArrayHasKey('common_name', $data[0]);
        $this->assertArrayHasKey('official_name', $data[0]);
        $this->assertArrayHasKey('symbol', $data[0]);
        $this->assertEquals(10, $data["page"]);
        $this->assertEquals(16, $data["Totalpage"]);
    }

    //country test start here
    public function testGetCountry()
    {
        $response = $this->http->request('GET', 'api/FetchCountry.php');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('continent_code', $data[0]);
        $this->assertArrayHasKey('currency_code', $data[0]);
        $this->assertArrayHasKey('iso2_code', $data[0]);
        $this->assertArrayHasKey('is03_code', $data[0]);
        $this->assertArrayHasKey('iso_numeric_code', $data[0]);
        $this->assertArrayHasKey('fips_code', $data[0]);
        $this->assertArrayHasKey('calling_code', $data[0]);
        $this->assertArrayHasKey('common_name', $data[0]);
        $this->assertArrayHasKey('official_name', $data[0]);
        $this->assertArrayHasKey('endonym', $data[0]);
        $this->assertArrayHasKey('demonym', $data[0]);
        $this->assertEquals(1, $data["page"]);
        $this->assertEquals(50, $data["Totalpage"]);

    }

    public function testSearchCountry()
    {
        $response = $this->http->request('GET', 'api/FetchCountry.php?search=Antarctica');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('continent_code', $data[0]);
        $this->assertArrayHasKey('currency_code', $data[0]);
        $this->assertArrayHasKey('iso2_code', $data[0]);
        $this->assertArrayHasKey('is03_code', $data[0]);
        $this->assertArrayHasKey('iso_numeric_code', $data[0]);
        $this->assertArrayHasKey('fips_code', $data[0]);
        $this->assertArrayHasKey('calling_code', $data[0]);
        $this->assertArrayHasKey('common_name', $data[0]);
        $this->assertArrayHasKey('official_name', $data[0]);
        $this->assertArrayHasKey('endonym', $data[0]);
        $this->assertArrayHasKey('demonym', $data[0]);
    }

    public function testPaginationCountry()
    {
        $response = $this->http->request('GET', 'api/FetchCountry.php?page=20');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('continent_code', $data[0]);
        $this->assertArrayHasKey('currency_code', $data[0]);
        $this->assertArrayHasKey('iso2_code', $data[0]);
        $this->assertArrayHasKey('is03_code', $data[0]);
        $this->assertArrayHasKey('iso_numeric_code', $data[0]);
        $this->assertArrayHasKey('fips_code', $data[0]);
        $this->assertArrayHasKey('calling_code', $data[0]);
        $this->assertArrayHasKey('common_name', $data[0]);
        $this->assertArrayHasKey('official_name', $data[0]);
        $this->assertArrayHasKey('endonym', $data[0]);
        $this->assertArrayHasKey('demonym', $data[0]);
        $this->assertEquals(20, $data["page"]);
        $this->assertEquals(50, $data["Totalpage"]);

    }
}

?>