<?php

namespace app\controllers;

use app\services\ConnectionCreator;
use PDO;

class LoginController
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct()
    {
        $this->connection = ConnectionCreator::getInstance()->createConnection();
    }

    public function index()
    {
        require __DIR__ . '/../SimpleForm.html';
    }

    public function indexRegister()
    {
        require __DIR__ . '/../RegisterPage.html';
    }

    public function login()
    {
        $decodedData = json_decode(file_get_contents("php://input"), true);
        $preparedQuery = $this->connection->prepare(
            'SELECT id FROM `users` WHERE login = :login'
        );
        $user = $preparedQuery->fetchAll([],['login' => $decodedData['login']]);

        if (count($user)) {
            echo 'logged in';

            return;
        }

        echo 'user no found';
    }

    public function register()
    {
        $decodedData = json_decode(file_get_contents("php://input"), true);
        $preparedQuery = $this->connection->prepare(
            'INSERT INTO `users` (login, email, password) VALUES (:login, :email, :password)'
        );
        $isDataInserted =  $preparedQuery->execute([
            'login' => $decodedData['login'],
            'email' => $decodedData['email'],
            'password' => $decodedData['password']
        ]);

        if ($isDataInserted) {
            echo 'success register';

            return;
        }

        echo 'register is fault';
    }
}