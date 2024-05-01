<!-- Chứa các hằng số cố định của project -->
<?php

const _MODULE = 'user';
const _ACTION = 'index';

const _CODE = true;

// Thiết lập host
define('_WEB_HOST', 'http://'.$_SERVER['HTTP_HOST'].'/LT_Web2');
define('_WEB_HOST_TEMPLATES', _WEB_HOST.'/templates');

// Thiết lập path
define('_WEB_PATH', __DIR__);
define('_WEB_PATH_TEMPLATES', _WEB_PATH.'/templates');

// Connect db
// const _HOST = 'localhost';
// const _DB = 'webbanao';
// const _USER = 'root';
// const _PASS = '';