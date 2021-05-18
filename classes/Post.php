<?php
    include_once(__DIR__ . "./../database/Db.php");
    include_once(__DIR__ . "User.php");

    class Post{
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

        public function uploadImage($image, $description){
            session_start();
            $id = $_SESSION['id'];
            $targetDir = (__DIR__ . "./../uploads/");
            $fileName = $id . "_" . basename($image['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            if(isset($_POST["submit"]) && !empty($image)){
                // Allow certain file formats
                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($image["tmp_name"], $targetFilePath)){
                        // Insert image file name into database
                        $obj = Db::getInstance();
                        $conn = $obj->getConnection();
                        $statement = $conn->prepare("insert into posts (imagePath, uploadDate, user_id, description) values (:image, now(), :id, :description)");

                        $statement->bindValue(":image", $fileName);
                        $statement->bindValue(":id", $id);
                        $statement->bindValue(":description", $description);
                        $result = $statement->execute();
                        var_dump($result);
                        if($result){
                            $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                        }else{
                            $statusMsg = "File upload failed, please try again.";
                        }
                    }else{
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                }
            }else{
                $statusMsg = 'Please select a file to upload.';
            }

// Display status message
            echo $statusMsg;
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
            $statement = $conn->prepare("select * from posts where (user_id) = (:user_id)");
            $statement->bindValue(":user_id", $id);
            $statement->execute();
            return $statement->fetchAll();
        }

        public function load20():array{
            $obj = Db::getInstance();
            $conn = $obj->getConnection();
            $statement = $conn->prepare("select * from posts");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
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

