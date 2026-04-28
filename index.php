<?php

$request_uri = $_SERVER['REQUEST_URI'];
$base_path = dirname($_SERVER['SCRIPT_NAME']);
if ($base_path === '/') {
    $base_path = '';
}

$route = str_replace($base_path, '', $request_uri);
$route = explode('?', $route)[0]; // Remove query string

// Simple routing
$view = 'home';
$params = [];

if ($route === '/' || $route === '') {
    $view = 'home';
} elseif (preg_match('/^\/news\/([a-zA-Z0-9_-]+)$/', $route, $matches)) {
    $view = 'news';
    $params['id'] = $matches[1];
} elseif ($route === '/login') {
    $view = 'login';
} elseif ($route === '/register') {
    $view = 'register';
} elseif ($route === '/profile') {
    $view = 'profile';
} elseif ($route === '/admin') {
    $view = 'admin';
} else {
    $view = '404';
}

$content = "views/{$view}.php";

if (!file_exists($content) && $view !== '404') {
    $view = '404';
    $content = "views/{$view}.php";
}

if (!file_exists('views/layout.php')) {
    if (file_exists($content)) {
        require_once $content;
    } else {
        echo "404 Not Found";
    }
} else {
    require_once 'views/layout.php';
}
