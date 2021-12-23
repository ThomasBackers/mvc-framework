<?php

namespace app\core;

class Request
{
  public function getPath()
  {
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    $questionMarkPosition = strpos($path, '?');
    if ($questionMarkPosition === false) {
      return $path;
    }
    return substr($path, 0, $questionMarkPosition);
  }

  public function method()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  public function isGet()
  {
    // return a boolean
    return $this->method() === 'get';
  }

  public function isPost()
  {
    return $this->method() === 'post';
  }

  public function getBody()
  {
    $body = [];
    if ($this->method() === 'get') {
      foreach ($_GET as $key => $value) {
        // have a look at the superglobal get
        // at the following key
        // take the value and remove the invalid characters
        // then put it inside the body
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }
    $body = [];
    if ($this->method() === 'post') {
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }
    return $body;
  }
}
