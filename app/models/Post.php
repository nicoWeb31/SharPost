<?php 

class Post {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //get posts
    public function getPosts(){
        $this->db->query('SELECT *,
        posts.id as postId,
        users.id as userId,
        posts.created_at as postDate,
        users.created_at as usersCreated

        from posts 
        INNER JOIN users
        on posts.user_id = users.id
        ORDER BY posts.created_at DESC');

        $result = $this->db->resultSet();
        return $result;
    }

    //add post
    public function addPost($data){
        $this->db->query('INSERT INTO posts (title,user_id,body) value (:title,:userId,:body)');
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':userId',$data['user_id']);
        $this->db->bind(':body',$data['body']);

        //exectut
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    


}