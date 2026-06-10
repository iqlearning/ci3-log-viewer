<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['timezone'] = 'UTC';
$config['base_path'] = APPPATH . 'logs/';
$config['exclude_ip_from_identifiers'] = false;

// Return true to allow, false to deny access
$config['auth_callback'] = function() {
    return true; 
};
