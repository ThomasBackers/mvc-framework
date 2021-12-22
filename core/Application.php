<?php

namespace app\core;

class Application
{
  public static $ROOT_DIR;
  public Router $router;
  public Request $request;
  public Response $response;
  // using this
  public static Application $app;
  public function __construct($rootPath)
  {
    self::$ROOT_DIR = $rootPath;
    // and that, the objet is able to refer to its own instance
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}