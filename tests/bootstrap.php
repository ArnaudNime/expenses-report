<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if (!function_exists('getPdoForTest')) {
    function getPdoForTest(): PDO
    {
        $pdo = new PDO('pgsql:host=127.0.0.1;port=5433;dbname=app;user=dev_user;password=dev_password');
        $pdo->exec('TRUNCATE expense_report, company, commercial CASCADE');
        $pdo->exec('ALTER SEQUENCE company_id_seq RESTART WITH 1');
        $pdo->exec('ALTER SEQUENCE commercial_id_seq RESTART WITH 1');
        $pdo->exec('ALTER SEQUENCE expense_report_id_seq RESTART WITH 1');

        return $pdo;
    }
}

getPdoForTest();


