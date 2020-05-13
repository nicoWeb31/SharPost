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

    //show one post 
    public function getPostById($id){
        $this->db->query('SELECT * FROM  posts WHERE id = :id');
        $this->db->bind(':id',$id);

        $resul = $this->db->single();
        return $resul;
    }


    //updatePost
    public function updatePost($data){
        $this->db->query('UPDATE posts SET title = :title, body = :body  WHERE id = :id');
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        $this->db->bind(':id',$data['id']);

        //exectute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    //delete post 
    public function deletePost($id){
        $this->db->query('DELETE FROM posts where id = :id');
        $this->db->bind(':id',$id);
        //exectute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    


}