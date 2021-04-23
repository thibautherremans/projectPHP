<?php
    include_once(__DIR__ . "../database/Db.php");

    class Post{
        private $image;
        private $description;

        public function getDescription()
        {
            return $this->description;
        }

        public function setDescription($description): void
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
            //controleren op grootte
            $check = getimagesize($image);
            if($check != false){

            }else{
                echo("mislukt");
                throw new Exception("image not uploaded correctly");
            }
            //controleren op bestandstype

            //downscalen naar kleinere grootte


        }

        function UploadImage($image){

                $conn  = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
                $statement = $conn->prepare("insert into post where (mediafile) = (:image)");
                $statement->bindValue(":image", $image);
                $statement->execute();
                $result = $statement->fetch();

        }



    }