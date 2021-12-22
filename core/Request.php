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

  public function getMethod()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }
}
