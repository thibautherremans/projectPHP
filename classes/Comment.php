<?php
    include_once(__DIR__ . "./../database/Db.php");
    include_once(__DIR__ . "./Post.php");

    class Comment{
        public function __construct()
        {

        }
        private $text;
        private $user_id;
        private $post_id;

        /**
         * @return mixed
         */
        public function getPostId()
        {
            return $this->post_id;
        }

        /**
         * @param mixed $post_id
         */
        public function setPostId($post_id): void
        {
            $this->post_id = $post_id;
        }

        /**
         * @return mixed
         */
        public function getUserId()
        {
            return $this->user_id;
        }

        /**
         * @param mixed $user_id
         */
        public function setUserId($user_id): void
        {
            $this->user_id = $user_id;
        }

        /**
         * @return mixed
         */
        public function getText()
        {
            return $this->text;
        }

        /**
         * @param mixed $text
         */
        public function setText($text): void
        {
            $this->text = $text;
        }

        public function save(){
            session_start();
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("insert into comments (message, user_id, post_id, post_date) values (:text, :user_id, :post_id, now())");
            $statement->bindValue(":text", $this->getText());
            $statement->bindValue(":user_id", $this->getUserId());
            $statement->bindValue(":post_id", $this->getPostId());
            $result = $statement->execute();
            return $result;
        }

        public function loadComments($id):array{
            session_start();
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from comments where post_id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }