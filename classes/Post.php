<?php

include_once(__DIR__ . "/Db.php");

class Post
{
    private $title;
    private $image;
    private $description;
    private $tags;

    public function setUserId($userId)
    { 
        $this->userId = $userId;
        return $this;
    }

    public function getUserId(){
        return $this->userId;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        if (empty($title)) {
            throw new Exception("Title cannot be empty");
        }
        $this->title = $title;
        return $this;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }


    public function getTags()
    {

        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

 
    public function setDescription($description)
    {
        if (empty($description)) {
            throw new Exception("description cannot be empty");
        }
        $this->description = $description;
        return $this;
    }

    public static function getAll()
    {
        $limit=20;
        $page= isset( $_GET['page']) ? $_GET['page'] : 1; //hiermee stellen we de home gelijk aan pagina 1
        $start= ($page -1) * $limit; //het start bij 0 en gaat tot $limit

        $conn = Db::getInstance();
        $result = $conn->query("select * from posts INNER JOIN users ON posts.user_id = users.id ORDER BY date DESC LIMIT $start, $limit");
        return $result->fetchAll();
    }

   /* public static function getUserId()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT posts.user_id, users.username FROM posts INNER JOIN users ON posts.user_id = users.id;");
     //   $statement->bindValue('user_id', $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public function setProjectInDatabase()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into posts (title, image, description, date) values (:title, :image, :description, now())");
        
        $title = $this->getTitle();
        $image = $this->getImage();
        $description = $this->getDescription();
        //$tags = $this->getTags();
        $statement->bindValue(":title", $title);
        $statement->bindValue(":image", $image);
        $statement->bindValue(":description", $description);
       // $statement->bindValue(":tags", $tags);
        $result = $statement->execute();
        return $result;
    }

    public function canUploadProject()
    {
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt)); //check in lowercase
    
        $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'svg');
    
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) {
                   // $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'uploaded_projects/' . $fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $image = basename($fileName);
                    $this->setImage($image);
                    $this->setProjectInDatabase($image);
                    
                } else {
                    throw new Exception("Your file is too large!");
                }
            } else {
                throw new Exception("There was an error uploading your file");
            }
        } else {
            throw new Exception("You cannot upload files of this type");
        }

    }
    }


   
