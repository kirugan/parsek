<?php
require_once __DIR__ . '/../config/autoload.php';

class CurlHttpClientTest extends PHPUnit_Framework_TestCase{
    
    public function testGetSuccess(){
        $url = $this->getTestURL('get.php');//'get.php'
        
        $client = new CurlHttpClient();
        $content = $client->get($url);
        
        $this->assertEquals('GET REQUEST SUCCESS', $content);
    }
    /**
     * @dataProvider getQuerySuccessDataProvider
     */
    public function testGetQuerySuccess($url, $params, $expected){
        $url = $this->getTestURL($url);
        
        $client = new CurlHttpClient($client);
        $content = $client->get($url, $params);
        
        $this->assertEquals($expected, $content);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionCode CURLE_COULDNT_RESOLVE_HOST
     */
    public function testGetFail(){
        $client = new CurlHttpClient();
        $content = $client->get(NOTEXISTINGHOST);
    }
    /**
     * @dataProvider getResponseCodeDataProvider
     */
    public function testGetResponseCode($_url, $expected_code){
        $url = $this->getTestURL($_url);
        
        $client = new CurlHttpClient();
        $client->get($url);
        $code = $client->getResponseCode();
        
        $this->assertEquals($expected_code, $code);
    }
    
    /* HELPERS */
    public function getResponseCodeDataProvider(){
        return array(
            array('get.php', 200),
            array('404.php', 404),
            array('redirect.php?code=301', 301),
            array('redirect.php?code=302', 302)
        );
    }
    
    public function getQuerySuccessDataProvider(){
        $params = array('first' => 1, 'second' => 2, 'third' => 3);
        
        return array(
            array('query.php', $params, 'first=1&second=2&third=3'),
            array('query.php?zero', $params, 'zero&first=1&second=2&third=3'),
        );
    }
    
    private function getTestURL($path){
        if(strpos($path, 'http://') === 0){
            return $path;
        } else {
            return TESTHOST . "curl_http_client/{$path}";
        }
    }
}