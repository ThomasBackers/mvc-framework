<?php

namespace app\core\form;

use app\core\Model;

class Form
{
  public static function begin($action, $method)
  {
    // replace the %s with the variables in order of appearance
    echo sprintf('<form action="%s" method="%s">', $action, $method);
    return new Form();
  }

  public static function end()
  {
    echo '</form>';
  }

  public function field(Model $model, $attribute)
  {
    return new Field($model, $attribute);
  }
}
