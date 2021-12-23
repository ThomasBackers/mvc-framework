<?php

namespace app\core;

// abstract to avoid creating an instance of this model
// this can only be used to create child classes
abstract class Model
{
  public const RULE_REQUIRED = 'required';
  public const RULE_EMAIL = 'email';
  public const RULE_MIN = 'min';
  public const RULE_MAX = 'max';
  public const RULE_MATCH = 'match';

  public function loadData($data)
  {
    foreach ($data as $key => $value) {
      // if property 'key' exists in $this 
      if (property_exists($this, $key)) {
        $this->{$key} = $value;
      }
    }
  }

  // we need one in every child
  // but rules are specifics to those children
  // so -> abstract
  // and it's supposed to return an array
  abstract public function rules(): array;

  public function validate()
  {
    foreach ($this->rules() as $attribute => $rules) {
      $value = $this->{$attribute};
      foreach ($rules as $rule) {
        $ruleName = $rule;
        // if it's not a string it is an array
        if (!is_string($ruleName)) {
          $ruleName = $rule[0];
        }
      }
    }
  }
}
