<?php
$code = isset($_GET['code']) ? $_GET['code'] : 301;

header("HTTP/1.1 $code Moved Permanently");