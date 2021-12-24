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

  public array $errors = [];

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
        if ($ruleName === self::RULE_REQUIRED && !$value) {
          $this->addError($attribute, self::RULE_REQUIRED);
        }
        // if the rulename is email but the filter of the value is unsuccessful
        // this is not a valid email
        if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $this->addError($attribute, self::RULE_EMAIL);
        }
        if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
          $this->addError($attribute, self::RULE_MIN, $rule);
        }
        if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
          $this->addError($attribute, self::RULE_MAX, $rule);
        }
        // in RegisterModel: [self::RULE_MATCH, 'match' => 'password']
        // so $rule['match'] gonna return 'password'
        if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
          $this->addError($attribute, self::RULE_MATCH, $rule);
        }
      }
    }
    return empty($this->errors);
  }

  public function addError(string $attribute, string $rule, $params = [])
  {
    $message = $this->errorMessages()[$rule] ?? '';
    foreach($params as $key => $value) {
      // replase {$key} by $value inside $message
      // for example, we're replacing {min} by 8 into $message
      $message = str_replace("{{$key}}", $value, $message);
    }
    $this->errors[$attribute][] = $message;
  }

  public function errorMessages()
  {
    return [
      self::RULE_REQUIRED => 'This field is required',
      self::RULE_EMAIL => 'This field must be a valid email',
      self::RULE_MIN => 'Min length of this field must be {min}',
      self::RULE_MAX => 'Max length of this field must be {max}',
      self::RULE_MATCH => 'This field must be the same as {match}'
    ];
  }

  public function hasError($attribute)
  {
    return $this->errors[$attribute] ?? false;
  }

  public function getFirstError($attribute)
  {
    return $this->errors[$attribute][0] ?? false;
  }
}
