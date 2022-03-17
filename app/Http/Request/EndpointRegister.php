<?php
namespace App\Http\Request;

class EndpointRegister {
  protected static $endpoints = array();
  const POST = 'POST';
  const GET = 'GET';

  function __construct() {}

  public static function get($controller_class, $action) {
    self::$endpoints[] = [
      'request_method'  => self::GET,
      'controller'      => $controller_class,
      'action'          => $action
    ];
  }

  public static function post($controller_class, $action) {
    self::$endpoints[] = [
      'request_method'  => self::POST,
      'controller'      => $controller_class,
      'action'          => $action
    ];
  }

  public static function listEndpoints() {
    echo '<code>';
    print_r(self::$endpoints);
    echo '</code>';
  }
}