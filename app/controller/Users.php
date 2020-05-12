<?php 


class Users extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register(){
        //check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process the form
            //sanitize Post data
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data = [

                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>''

            ];

            //validate email
            if(empty($data['email'])){
                $data['email_err'] = "please enter email";
            }else{
                //check email
                if($this->userModel->findUserByMail($data['email'])){
                    $data['email_err'] = "email is alredy taken";
                }
            }

             //validate name
            if(empty($data['name'])){
                $data['name_err'] = "please enter name";
            }

              //validate password
            if(empty($data['password'])){
                $data['password_err'] = "please enter password";
            }else if(strlen($data['password']) < 7 ){
                $data['password_err'] ="password must be at least 7 caracters";
            }

             //validate comfirm password
             if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = "please comfirm password";
            }else{

                if ($data['confirm_password'] !== $data['password']){
                    $data['confirm_password_err'] ="password doesnt't match";
                }

            }


            //make sur error are empty
            if(empty($data['confirm_password_err']) && empty($data['password_err']) && empty($data['email_err']) && empty($data['name_err'])){
                //validated
                // die('success');
                //Hash password
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                //register user 
                if($this->userModel->register($data)){
                    redirect('users/login');
                }else{

                }
                

            }else{
                //load view with error
                $this->view('user/register',$data);
            }


        }else{
            //Load the form
            $data = [
                'title'=>'Register',
                'description'=>'form to register',
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=>'',
                'email_err'=>'',

                'password_err'=>'',
                'confirm_password_err'=>''

            ];
            //load view 
            $this->view('user/register',$data);
        }
    }


    public function login(){
        //check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process the form
            //sanitize Post data
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [


                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>'',

            ];

            //validate email
            if(empty($data['email'])){
                $data['email_err'] = "please enter email";
            }

            //validate password
            if(empty($data['password'])){
                $data['password_err'] = "please enter password";
            }

            //make sur error are empty
            if(empty($data['password_err']) && empty($data['email_err'])){
                //validated
                die('success');
            }else{
                //load view with error
                $this->view('user/login',$data);
            }



        }else{
            //Load the form
            $data = [
                'title'=>'Login',
                'email'=>'',
                'password'=>'',
                'email_err'=>'',
                'password_err'=>'',

            ];
            //load view 
            $this->view('user/login',$data);
        }
    }
}