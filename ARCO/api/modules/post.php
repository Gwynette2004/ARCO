<?php

require_once "global.php";

class Post extends GlobalMethods{

    private $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }


    function signup($data){
        global $pdo; 
        if(!isset($data->username) || !isset($data->email) || !isset($data->password)) {
            return ['error' => 'Missing fields'];
        } 
    
        $stmt = $pdo->prepare("SELECT userid FROM users WHERE username = :username OR email = :email"); 
        $stmt->execute(['username' => $data->username, 'email' => $data->email]);
    
        if($stmt->rowCount() > 0) {
            return ['error' => 'Username or email already exists'];
        }
    
        $password_hash = password_hash($data->password, PASSWORD_DEFAULT);
     
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) 
                               VALUES (:username, :email, :password_hash)");
        try{
            $stmt->execute([
                'username' => $data->username,
                'email' => $data->email,
                'password_hash' => $password_hash
            ]);
            return $this->sendPayload(null, "Success", "Signup Successful", 200);
        } catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 400;
        }
        return $this->sendPayload(null, "Failed", $errmsg, $code);
    }



    public function login($data) {
        try {
            if (empty($data->email) || empty($data->password)) {
                throw new Exception("All input fields are required!");
            }
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $data->email);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $this->handleLoginVerification($result, $data->password);
        } catch (\Exception $e) {
            return $this->sendPayload(null, 'failed', $e->getMessage(), 400);
        }
    }

    private function handleLoginVerification($result, $password) {
        if ($result && count($result) > 0) {
            $row = $result[0];
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['userid'] = $row['userid'];
                return $this->sendPayload(null, 'success', 'Login successful', 200);
            } else {
                return $this->sendPayload(null, 'failed', 'Email or Password is Incorrect!', 401);
            }
        } else {
            return $this->sendPayload(null, 'failed', 'User not found', 404);
        }
    }
}



?>