<?php
function base_url($atRoot = false, $atCore = false, $parse = false) {
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $scheme = 'https';
    } else {
        $scheme = 'http';
    }
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    $base = $scheme . '://' . $host . ($atRoot ? '' : dirname($uri));

    if ($atCore) {
        $core = explode('/', trim($uri, '/'));
        $base .= '/' . $core[0];
    }
    
    return $parse ? parse_url($base) : $base;
}
?>