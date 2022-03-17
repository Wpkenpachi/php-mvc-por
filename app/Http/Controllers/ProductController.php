<?php
namespace App\Http\Controllers;

class ProductController {
  function construct() {
    echo __CLASS__ . " has been initialized!" . PHP_EOF;
  }

  public function list() {
    return [
      'name'      => 'Iphone 8 plus',
      'category'  => 'Eletronics',
      'size'      => '158.4 mm'
    ];
  }

  public function show($data) {
    return $data;
  }

  public function store($payload) {
    return $payload;
  }
}