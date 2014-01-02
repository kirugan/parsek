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
        
        if(count($params) > 0){
            $query = http_build_query($params);
            $url .= strpos($url, '?') === false ? "?$query" : "&$query";
        }
        
        $this->setCurlOptions(array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPGET => true
        ));
        return $this->exec();
    }
    public function post($url, $params = array()){
        $curl = $this->getCurlHandler();
        
        $this->setCurlOptions(array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params
        ));
    }
    public function getResponseCode(){
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }
    protected function exec(){
        $response = curl_exec($this->curl);
        if($response === false){
            $this->processError();
        }
        return $response;
    }
    public function setCurlOptions(array $_options){
        $default = array(
            CURLOPT_RETURNTRANSFER => true
        );
        $options = $default + $_options;
        
        curl_setopt_array($this->curl, $options);
    }
    /**
     * @todo сделать по другому обработку ошибок?
     * @throws Exception
     */
    private function processError(){
        $curl_error = curl_error($this->curl);
        // Важно! curl_getinfo не сможет дать инфу 
        // о последнем запросе если подключение fail
        // единственный способ посмотреть на код ошибки
        $error_number = curl_errno($this->curl);
        throw new Exception($curl_error, $error_number);
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
