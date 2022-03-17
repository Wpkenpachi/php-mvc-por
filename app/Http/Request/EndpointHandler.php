<?php
namespace App\Http\Request;
use App\Http\Request\EndpointRegister;

class EndpointHandler extends EndpointRegister {
  private $request_method = null;
  private $controller     = null;
  private $action         = null;
  private $endpoint_list  = array();

  function __construct() {
    $this->endpoint_list = parent::$endpoints;
  }

  private function runEndpointMatcher() {
    foreach ($this->endpoint_list as $endpoint):
      if (
          $endpoint['action'] === strtolower($this->action) &&
          $endpoint['request_method'] === $this->request_method
      ) {
        return $endpoint;
      }
    endforeach;
  }

  private function initialize() {
    $this->request_method = $_SERVER['REQUEST_METHOD'];
    $this->action     = $_GET['action'];

    if (!$this->action || !$this->request_method) {
      return http_response_code(404);
    }
  }

  private function getRequestPayloads() {
    $queries              = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $body                 = file_get_contents('php://input');
    if (json_last_error() == JSON_ERROR_NONE) {
      return [
        'queries' => $queries,
        'body' => $body
      ];
    }

    return http_response_code(500);
  }

  private function runEndpointExecutor($endpoint) {
    $controller_instance  = new $endpoint['controller'];
    $action               = $endpoint['action'];
    $payload              = $this->getRequestPayloads();
    return self::response_json($controller_instance->$action($payload));
  }

  public static function response_json($payload) {
    $response = json_encode($payload);
    die($response);
  }

  public function listen() {
    $this->initialize();
    $matched_endpoint = $this->runEndpointMatcher();
    if ($matched_endpoint) {
      $this->runEndpointExecutor($matched_endpoint);
    } else {
      return http_response_code(404);
    }
  }
}