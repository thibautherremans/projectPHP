<?php
    include_once(__DIR__ . "./../database/Db.php");
    class Image{
        private $image;
        private $description;

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param mixed $description
         */
        public function setDescription($description): void
        {
            $this->description = $description;
        }

        /**
         * @return mixed
         */
        public function getImage()
        {
            return $this->image;
        }

        /**
         * @param mixed $image
         */
        public function setImage($image): void
        {
            $this->image = $image;
        }

        public function checkType($image){
            session_start();
            $id = $_SESSION['id'];
            $targetDir = (__DIR__ . "./../uploads/");
            $fileName = $id . "_" . basename($image['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(isset($_POST["submit"]) && !empty($image)){
                if(in_array($fileType, $allowTypes)){
                    return true;
                }else{
                    throw new Exception("this file type is not supported, try another file");
                }
            }
        }

        public function uploadImagePost($image, $description){
            session_start();
            $id = $_SESSION['id'];
            $targetDir = (__DIR__ . "./../uploads/");
            $fileName = $id . "_" . basename($image['name']);
            $targetFilePath = $targetDir . $fileName;

            if(move_uploaded_file($image["tmp_name"], $targetFilePath)){
                $obj = Db::getInstance();
                $conn = $obj->getConnection();
                $statement = $conn->prepare("insert into posts (imagePath, uploadDate, user_id, description) values (:image, now(), :id, :description)");

                $statement->bindValue(":image", $fileName);
                $statement->bindValue(":id", $id);
                $statement->bindValue(":description", $description);
                $result = $statement->execute();

                if($result){
                    return $result;
                }else{
                    throw new Exception("file upload has failed, please try again");
                }
            }
        }

        public function uploadImageProfile($image){
            $id = $_SESSION['id'];
            session_start();
            $targetDir = (__DIR__ . "./../uploads/profilepictures/");
            $fileName = $id . "_" . basename($image['name']) ;
            $targetFilePath = $targetDir . $fileName;

            if(move_uploaded_file($image["tmp_name"], $targetFilePath)){
                $obj = Db::getInstance();
                $conn = $obj->getConnection();
                $statement = $conn->prepare("UPDATE users SET profile_picture = (:image) WHERE users.id = (:id)");

                $statement->bindValue(":image",$fileName);
                $statement->bindValue(":id", $id);
                $result = $statement->execute();

                if($result){
                    return $result;
                }else{
                    throw new Exception("file upload has failed, please try again");
                }
            }

        }
    }