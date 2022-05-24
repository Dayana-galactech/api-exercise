<?php

class URLRouter {

  private static $routes = array(
    'GET' => array(),
    'POST' => array(),
    'PUT' => array(),
    'DELETE' => array(),
  );

  public static function get($baseURL, $controllerName, $actionName) {
    self::$routes['GET'][$baseURL] = [$controllerName, $actionName];
  }

  public static function post($baseURL, $controllerName, $actionName) {
    self::$routes['POST'][$baseURL] = [$controllerName, $actionName];
  }

  public static function put($baseURL, $controllerName, $actionName) {
    self::$routes['PUT'][$baseURL] = [$controllerName, $actionName];
  }

  public static function delete($baseURL, $controllerName, $actionName) {
    self::$routes['DELETE'][$baseURL] = [$controllerName, $actionName];
  }

  public static function resource($baseURL, $controllerName) {
    self::$routes['GET'][$baseURL]                  = [$controllerName , 'index'];
    self::$routes['GET'][$baseURL    . '/index']       = [$controllerName , 'index'];
    self::$routes['GET'][$baseURL    . '/show']        = [$controllerName , 'show'];
    self::$routes['GET'][$baseURL    . '/create']      = [$controllerName , 'create'];
    self::$routes['POST'][$baseURL   . '/store']      = [$controllerName , 'store'];
    self::$routes['GET'][$baseURL    . '/edit']        = [$controllerName , 'edit'];
    self::$routes['PUT'][$baseURL    . '/update']      = [$controllerName , 'update'];
    self::$routes['DELETE'][$baseURL . '/destroy']  = [$controllerName , 'destroy'];
  }

  public static function isValid($requestMethod, $url) {
    return isset(self::$routes[$requestMethod][$url]);
  }

  public static function execute($requestMethod, $url) {
    list ($controller, $action) = self::$routes[$requestMethod][$url];
    $className = "Controllers\\" . $controller;
    $class =  new $className();

    $params = [];
    parse_str(file_get_contents("php://input"),$params);

    return $class->{$action}([
      'data' => array_merge($_GET, $_POST, $params)
    ]);
  }
}