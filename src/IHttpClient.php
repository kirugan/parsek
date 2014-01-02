<?php
/**
 *
 * @author kirugan
 */
interface IHttpClient {
    /**
     * method for GET request
     */
    public function get($url, $params = array());
    /**
     * method for POST request
     */
    public function post($url, $params = array());
}
