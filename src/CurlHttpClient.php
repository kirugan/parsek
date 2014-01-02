<?php
/**
 * Description of CurlHttpClient
 *
 * @author kirugan
 */
class CurlHttpClient implements IHttpClient{
    private $curl = null;
    
    public function get($url, $params = array()){
        $curl = $this->getCurlHandler();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPGET => true
        ));
        return $this->exec();
    }
    public function post($url, $params = array()){
        $curl = $this->getCurlHandler();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params
        ));
    }
    protected function exec(){
        
    }
    private function getCurlHandler(){
        if($this->curl === null){
            $curl = curl_init();
            if($curl !== false){
                $this->curl = $curl;
            } else {
                throw new Exception('Can`t initialize curl instance');
            }
        }
        
        return $this->curl;
    }
}
