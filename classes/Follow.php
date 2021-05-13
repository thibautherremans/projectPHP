<?php
    class Follow{
        private $user_id;
        private $follower_id;

        /**
         * @return mixed
         */
        public function getFollowerId()
        {
            return $this->follower_id;
        }

        /**
         * @param mixed $follower_id
         */
        public function setFollowerId($follower_id): void
        {
            $this->follower_id = $follower_id;
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

        public function follow(){
            $conn = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $conn->prepare("insert into following (user_id, follower_id) values (:user_id, :follower_id)");
            $statement->bindValue(":user_id", $this->getUserId());
            $statement->bindValue(":follower_id", $this->getFollowerId());
            $result = $statement->execute();
            return $result;
        }

    }
