<?php

namespace app\core\form;

class Form
{
  public static function begin()
  {
    return '<form action="" method="">';
  }

  public static function end()
  {
    return '</form>';
  }
}
