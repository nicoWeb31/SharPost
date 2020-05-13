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
                    flash('register_sucess','you are register you can login');
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
            

            //check for user/email
            if($this->userModel->findUserByMail($data['email'])){
                //user found 



            }else{
                //unser not fund
                $data['email_err']='User not found';


            }



            //make sur error are empty
            if(empty($data['password_err']) && empty($data['email_err'])){
                //validated
                //check and set logged in user
                $logguser = $this->userModel->login($data['email'],$data['password']);
                    if($logguser){
                        //create a session variable
                        $this->createUserSession($logguser);
                        //die('log ok')
                    }else{

                        $data['password_err'] = 'password incorrect';
                        $this->view('user/login',$data);

                    }

                // die('success');
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

    public function createUserSession($logUser){
        $_SESSION['user_id'] = $logUser->id;
        $_SESSION['user_email'] = $logUser->email;
        $_SESSION['user_name'] = $logUser->name;
        redirect('pages/index');

    }

        //logout
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            session_destroy();
            redirect('users/login');
    
        }

        public function isLogin(){
            if(isset($_SESSION['user_id'])){
                return true;
            }else{
                return false;
            }
        }
}