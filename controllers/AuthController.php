<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
  public function login()
  {
    $this->setLayout('auth');
    return $this->render('login');
  }

  public function register(Request $request)
  {
    if ($request->isPost()) {
      return 'Handle submitted data';
    }
    // the only other possible case is 'get'
    // so we simply render the view
    $this->setLayout('auth');
    return $this->render('register');
  }
}
