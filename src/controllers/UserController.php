<?php

require_once "src/models/User.php";

class UserController
{
    public function register()
    {
        $username = $_POST["username"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!isset($username) || !isset($name) || !isset($email) || !isset($password)) {
            require_once "src/screens/register/index.php";
        } else {
            $user = new User($email, $username, $name, $password);
            $result = $user->save();
            if (!is_bool($result)) {
                require_once "src/screens/login/index.php";
            } else {
                require_once "src/screens/register/index.php";
            }
        }
    }

    public function login()
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!isset($email) || !isset($password)) {
            require_once "src/screens/login/index.php";
        } else {
            $result = User::logIn($email, $password);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "username" => $result->getUsername(), "email" => $result->getEmail());
                require_once "src/screens/home/index.php";
            } else {
                require_once "src/screens/login/index.php";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?view=login");
    }
}