<?php

// is intended to be executed in the command prompt with $ php migrations.php
require_once __DIR__.'/vendor/autoload.php';

use app\core\Application;
use Dotenv;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
  'db' => [
    'dsn' => $_ENV['DB_DSN'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD']
  ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();
