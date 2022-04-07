<?php
class Post
{
    private $title;
    private $image;
    private $freetags;
    private $projectToUpload;


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        if (empty($title)) {
            throw new Exception("title cannot be empty");
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


    public function getFreetags()
    {
        return $this->freetags;
    }


    public function setFreetags($freetags)
    {
        $this->freetags = $freetags;
        return $this;
    }


    public function getProjectToUpload()
    {
        return $this->projectToUpload;
    }


    public function setProjectToUpload($projectToUpload)
    {
        $this->projectToUpload = $projectToUpload;
        return $this;
    }


    public static function getAll()
    {
        $conn = Db::getInstance();
        $result = $conn->query("select * from posts");
        return $result->fetchAll();
    }

   /* public function updateProjectInDatabase($projectToUpload, $id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE posts SET image = :projectToUpload WHERE id = :id");
        $statement->bindValue(":projectToUpload", $projectToUpload);
        $statement->bindValue(":id", $id);
        $statement->execute();
        header('Location: projectSettings.php#');
    }*/


    public function canUploadProject($projectToUpload)
    {
        /*$projectName = $_FILES['projectToUpload']['name']; //getting user uploaded name
        $projectTmpName = $_FILES['projectToUpload']['tmp_name']; //getting user uploaded img type
        $projectSize = $_FILES['projectToUpload']['size']; //this temporary name is used to save/move file in our folder

        $projectTarget = 'uploaded_projects/' . basename($projectName);
        $projectIsImage = getimagesize($projectTmpName);

        // Check file size
        if ($projectSize > 500000) {
            $canUpload = false;
            throw new Exception('Image size can not be larger than 5MB, try again.');
        }

         // Check if file is an image
         if ($projectIsImage !== false) {
            $canUpload = true;
        } else {
            $canUpload = false;
            throw new Exception("Your uploaded file is not an image.");
        }

        // Upload file when no errors
        if ($canUpload) {
            if (move_uploaded_file($projectTmpName, $projectTarget)) {
                $projectToUpload = basename($projectName);
                $this->setProjectToUpload($projectToUpload);
                header('Location: projectSettings.php');
        }
  
    }*/
    
    if (isset($_POST['submit']) && isset($_FILES['myProject'])) {
 
        $project = $_FILES['myProject'];
        print_r($project);
        $projectName = $_FILES['myProject']['name'];
        $projectTmpName = $_FILES['myProject']['tmp_name'];
        $projectSize = $_FILES['myProject']['size'];
        $projectError = $_FILES['myProject']['error'];
        $projectType = $_FILES['myProject']['type'];
    
        $projectExt = explode('.', $projectName);
        $projectActualExt = strtolower(end($projectExt)); //check in lowercase
    
        $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'svg');
    
        if (in_array($projectActualExt, $allowed)) {
            if ($projectError === 0) {
                if ($projectSize < 500000) {
                    $projectNameNew = uniqid('', true) . "." . $projectActualExt;
                    $projectDestination = 'uploaded_projects/' . $projectNameNew;
                    move_uploaded_file($projectTmpName, $projectDestination);
    
                    //insert into database
                    
    
                } else {
                    echo  "Your file is too large!";
                }
            } else {
                echo  "There was an error uploading your file";
            }
        } else {
            echo  "You cannot upload files of this type";
        }
    }
}
}