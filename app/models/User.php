<?php 


/**
 * model user recup db
 */

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

    //login 
    public function login($email,$password){
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        $hashedPassword = $row->password;
        if(password_verify($password,$hashedPassword)){
            return $row;
        }else{
            return false;
        }

    }



    //find user bny id
    public function getUserByid($id){
        $this->db->query('SELECT * from users where id = :id');
        $this->db->bind(':id',$id);

        $row = $this->db->single();

        return $row;
    }



}