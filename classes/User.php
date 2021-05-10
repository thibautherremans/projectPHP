<?php
    include_once(__DIR__ . "../database/Db.php");

    class User{
        private $email;
        private $password;
        private $picture;
        private $username;
        private $id;


        public function getId()
        {
            session_start();
            $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $conn->prepare("select id from users where (email) = (:email)");
            $statement->bindValue(":email", $_SESSION["email"]);
            $statement->execute();
            $result = $statement->fetch();
            var_dump($result);
            return $result['id'];
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }


        public function getUsername()
        {
            session_start();
            $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $conn->prepare("select username from users where (email) = (:email)");
            $statement->bindValue(":email", $_SESSION["email"]);
            $statement->execute();
            $result = $statement->fetch();
            return $result["username"];
        }

        public function setUsername($username)
        {
            $this->username = $username;
        }


        public function getPicture()
        {
            return $this->picture;
        }

        public function setPicture($picture)
        {
            $this->picture = $picture;
        }


        public function getEmail()
        {
            return $this->email;
        }


        public function setEmail($email)
        {
            $this->email = $email;
        }


        public function getPassword()
        {
            return $this->password;
        }


        public function setPassword($password)
        {
            if(strlen($password) < 5){
                throw new Exception("Passwords must be longer than 5 characters.");
            }

            $this->password = $password;
            return $this;
        }

        public function canLogin(){

            $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $conn->prepare("select * from users where (email) = (:email)");

            $email = $this->getEmail();
            $statement->bindValue(":email", $email);

            $statement->execute();
            $result = $statement->fetch();

            $password = $this->getPassword();
            $hash = $result['password'];


            if(password_verify($password, $hash)){
                return true;
            }else{
                return false;
                throw new Exception("password is not correct!");
            }
        }

        public function register(){
            $options = [
                "cost" => 14
            ];
            $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);

            $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $conn->prepare("insert into users (email, password, username) values (:email, :password, :username)");

            $statement->bindValue(":email", $this->getEmail());
            $statement->bindValue(":password", $password);
            $statement->bindValue(":username", $this->getUsername());

            echo "yeey het is gelukt";
            return $statement->execute();
        }

        public function changeName($name){
            if($name != $this->getUsername()){
                $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
                $statement = $conn->prepare("UPDATE users SET username = (:name) WHERE users.id = (:id);");
                $statement->bindValue(":name", $name);
                $statement->bindValue(":id", $_SESSION['id']);
                $result = $statement->execute();

                session_start();
                $_SESSION['username'] = $name;
                return $result;

            }else{
                throw new Exception("Username can't be the same as before!");
            }

        }

        public function changeEmail($email){
            if($email != $this->getEmail()){
                $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
                $statement = $conn->prepare("UPDATE users SET email = (:email) WHERE users.id = (:id);");

                $statement->bindValue(":email", $email);
                $statement->bindValue(":id", $_SESSION['id']);

                session_start();
                $_SESSION['email'] = $email;

                return $statement->execute();
            }else{
                throw new Exception("Email can't be the same as before!");
            }
        }

        public function changeDescription($description){
                $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
                $statement = $conn->prepare("UPDATE users SET description = (:description) WHERE users.id = (:id);");

                $statement->bindValue(":description", $description);
                $statement->bindValue(":id", $_SESSION['id']);

                return $statement->execute();
        }

        public function changePassword($newPass, $confPass){
            if($newPass === $confPass){
                $options = [
                    "cost" => 14
                ];
                $password = password_hash($confPass, PASSWORD_DEFAULT, $options);

                $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
                $statement = $conn->prepare("UPDATE users SET password = (:password) WHERE users.id = (:id);");
                $statement->bindValue(":password", $password);
                $statement->bindValue(":id", $_SESSION['id']);
                return $statement->execute();
            }else{
                throw new Exception ("password must be the same!");
            }
        }

        public function loadInfo($id){
            $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $conn->prepare("select * from users where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }



}