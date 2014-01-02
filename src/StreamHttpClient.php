<?php
/**
 * Description of StreamHttpClient
 *
 * @author kirill
 */
class StreamHttpClient implements IHttpClient{
    public function get($url, $params = array()){
        return file_get_contents($url);
    }
    public function post($url, $params = array()){
        $fields = http_build_query($params);
        $stream = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $fields
            )
        ));
        return file_get_contents($url, false, $stream);
    }
}
