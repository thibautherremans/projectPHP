<?php
    include_once(__DIR__ . "./../database/Db.php");
    include_once(__DIR__ . "User.php");

    class Post{
        public function __construct()
        {

        }
        private $image;
        private $description;
        private $tag;

        /**
         * @return mixed
         */
        public function getTag()
        {
            return $this->tag;
        }

        /**
         * @param mixed $tag
         */
        public function setTag($tag): void
        {
            $this->tag = $tag;
        }

        public function getDescription()
        {
            return $this->description;
        }

        public function setDescription($description)
        {
            if($description != null){
                $this->description = $description;
            }else{
                throw new Exception("description can not be empty");
            }

        }

        public function getImage()
        {
            return $this->image;
        }

        public function setImage($image)
        {
            $this->image = $image;
        }


        public function searchTag():array{
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from posts where (tag) like (:tag)");
            $statement->bindValue(":tag", $this->getTag());
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        public function loadByUser($id):array{
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from posts where (user_id) = (:user_id) ORDER BY id DESC");
            $statement->bindValue(":user_id", $id);
            $statement->execute();
            return $statement->fetchAll();
        }

        public function load20():array{
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from posts ORDER BY id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result){
                return $result;
            }else{
            throw new Exception("there is a problem with this page, try again later");
            }

        }

        public function load40():array{
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from posts ordered by id limit 40");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function delete($id){
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("delete from posts where id = :id");
            $statement2 = $conn->prepare("delete from comments where post_id = :id");
            $statement3 = $conn->prepare("delete from likes where post_id = :id");
            $statement->bindValue(":id", $id);
            $statement2->bindValue(":id", $id);
            $statement3->bindValue(":id", $id);
            $result = $statement->execute();
            $result2 = $statement2->execute();
            $result3 = $statement3->execute();
            return $result.$result2.$result3;
        }

    }

