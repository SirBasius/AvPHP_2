<?php

require_once "src/data/Connection.php";

class User
{
    private Int $id;
    private String $email;
    private String $name;
    private String $username;
    private String $password;

    function __construct(String $email, String $username, String $name, String $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->name = $name;
        $this->password = $password;
    }

    public function save()
    {
        try {
            $this->hashPassword();
            $email =  $this->getEmail();
            $password = $this->getPassword();
            $username = $this->getUsername();
            $name = $this->getName();
            $stmt = Connection::getConnection()->prepare('INSERT INTO users (username, email, name, password) VALUES (:username, :email, :name, :password)');
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":name", $name);
            $stmt->execute();
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private function hashPassword()
    {
        $this->setPassword(password_hash($this->password, PASSWORD_DEFAULT));
    }

    public static function listUsers()
    {
        try {
            $query = Connection::getConnection()->query('SELECT * FROM users');
            $list = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = User::mapUser($list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private static function mapUser($list){
        return array_map(function ($e) {
            $user =  new User($e['email'], $e['username'], $e['name'], $e['password']);
            $user->setId($e['id']);
            return $user;
        }, $list);
    }
    public static function search(String $searchTerm)
    {
        try {
            $stmt = Connection::getConnection()->prepare('SELECT * FROM users WHERE email like :search_term or username like :search_term or name like :search_term ');
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bindParam(":search_term", $searchTerm);
            $list = $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = User::mapUser($list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    public static function logIn(String $email, String $password)
    {
        try {
            $stmt = Connection::getConnection()->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = sizeof($result) > 0 ? $result[0] : NULL;
            if (is_null($user)) {
                throw new Exception("User not found");
            }
            if (!password_verify($password, $user['password'])) {
                throw new Exception("Invalid password");
            }
            $return = new User($user['email'], $user['username'], $user['name'], $user['password']);
            $return->setId($user['id']);
            return $return;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName(String $name)
    {
        $this->name = $name;

        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId(Int $id)
    {
        $this->id = $id;

        return $this;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(String $username)
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(String $password)
    {
        $this->password = $password;

        return $this;
    }
}
