<?php

namespace app\core;

class Application
{
  public static $ROOT_DIR;
  public Router $router;
  public Request $request;
  public Response $response;
  public Database $db;
  // using this
  public static Application $app;
  public Controller $controller;
  public function __construct($rootPath, array $config)
  {
    self::$ROOT_DIR = $rootPath;
    // and that, the class is able to refer to its own instance
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->db = new Database($config['db']);
  }

  public function getController()
  {
    return $this->controller;
  }

  public function setController($controller)
  {
    $this->controller = $controller;
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}
