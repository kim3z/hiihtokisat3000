<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class Post {
    private $db_table = 'posts';
    private $conn;

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $img;
    public $category_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Create post
     */
    function create() {
        $sql = 'INSERT INTO ' . $this->db_table . ' (user_id, title, content, img, category_id) VALUES (:user_id, :title, :content, :img, :category_id)';
        $stmt = $this->conn->prepare($sql);

        $params = array(
            ':user_id' => $this->user_id,
            ':title' => $this->title,
            ':content' => $this->content,
            ':img' => $this->img,
            ':category_id' => $this->category_id,
        );
        
        if ($stmt->execute($params)) {
            return true;
        }

        return false;
    }

    /**
     * Upload post image file
     */
    function uploadImage($img,$user_id) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $path = $user_id . '_img_'. md5(uniqid(rand(), true)). '_name_' . $img['name'];
        $target_file = $target_dir . $path;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo 'Sorry, file already exists.';
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            return false;
        
        } else if (move_uploaded_file($img['tmp_name'], $target_file)) {
            return $path;
        }

        return false;
    }
}
