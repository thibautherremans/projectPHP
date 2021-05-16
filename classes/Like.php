<?php
    class Like{
        private $post_id;
        private $user_id;

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

        public function like(){
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("insert into likes (post_id, user_id, likeDate) values (:post_id, :id, now())");
            $statement->bindValue(":post_id", $this->getPostId());
            $statement->bindValue(":id", $this->getUserId());
            $result = $statement->execute();
            return $result;
        }

        public function unLike(){
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("delete from likes where (post_id, user_id) = (:postId, :id)");
            $statement->bindValue(":post_id", $this->getPostId());
            $statement->bindValue(":id", $this->getUserId());
            $result = $statement->execute();
            return $result;
        }

        public function loadLikes($postId){
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from likes where post_id = :post_id");
            $statement->bindValue(":post_id", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }