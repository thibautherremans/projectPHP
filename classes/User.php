<?php
    include_once(__DIR__ . "../database/Db.php");

    class User{
        private $email;
        private $password;
        private $picture;
        private $username;


        public function getUsername()
        {
            return $this->username;
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

            $conn = Db::getInstance();
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

            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into users (email, password, username) values (:email, :password, :username)");

            $statement->bindValue(":email", $this->getEmail());
            $statement->bindValue(":password", $password);
            $statement->bindValue(":username", $this->getUsername());

            echo "yeey het is gelukt";
            return $statement->execute();
        }




}