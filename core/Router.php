<?php

namespace app\core;

class Router
{
  public Request $request;
  public Response $response;
  protected array $routes = [];

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  public function get($path, $callback)
  {
    $this->routes['get'][$path] = $callback;
  }

  public function post($path, $callback)
  {
    $this->routes['post'][$path] = $callback;
  }

  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->method();
    $callback = $this->routes[$method][$path] ?? false;
    if ($callback === false) {
      $this->response->setStatusCode(404);
      return $this->renderView('_404');
    }
    // if (is_string($callback)) {
    //   return $this->renderView($callback);
    // }
    if (is_array($callback)) {
      // instance generation from class
      // and replace class by instance in the array
      Application::$app->controller = new $callback[0]();
      $callback[0] = Application::$app->controller;
    }
    // take the callback which contains an object and a string
    // it search for a method called like the string in the object
    // and try to insert the request as param if possible
    return call_user_func($callback, $this->request);
  }

  public function renderView($view, $params = [])
  {
    $layoutContent = $this->layoutContent();
    $viewContent = $this->renderOnlyView($view, $params);
    // replace {{content}} with $viewContent inside $layoutContent
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  protected function layoutContent()
  {
    $layout = Application::$app->controller->layout;
    // start output caching
    ob_start();
    include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
    // return the cached value & clear the buffer
    return ob_get_clean();
  }

  protected function renderOnlyView($view, $params)
  {
    foreach ($params as $key => $value) {
      // use the key value as variable name :D
      $$key = $value;
    }
    ob_start();
    // and the include see those variables :DD
    include_once Application::$ROOT_DIR."/views/$view.php";
    return ob_get_clean();
  }
}
