<?php
/**
 * Description of CurlHttpClientFactory
 *
 * @author kirugan
 */
class CurlHttpClientFactory extends HttpClientFactory{
    public static function createInstance() {
        return new CurlHttpClient();
    }
}
