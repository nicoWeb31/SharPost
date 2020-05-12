<?php 

class User {
    private  $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //find user bny email
    public function findUserByMail($email){
        $this->db->query('SELECT * from users where email = :email');
        $this->db->bind(':email',$email);

        $row = $this->db->single();

        //check row
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //register
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name,email,password) value (:name,:email,:password)');
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':password',$data['password']);

        //exectut
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }
}