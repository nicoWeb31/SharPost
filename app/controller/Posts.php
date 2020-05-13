<?php 
class Posts extends Controller {


    private $postModel;


    public function __construct()
    {

        //load model
        $this->postModel = $this->model('Post');

        //si not login redirect log pages
        if(!isLogin()){
            redirect('users/login');
        }
    }


    public function index(){

        //get post
        $posts = $this->postModel->getPosts();

        $data = [
            'title'=>'Post index',
            'posts'=>$posts
        ];

        $this->view('posts/index',$data);
    }

    //methode verbe url
    public function add(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post array
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'user_id'=> $_SESSION['user_id'],
                'title_err'=> '',
                'body_err'=> ''
            ];

        //validation
        if(empty($data['title'])){
            $data['title_err'] = 'please enter title';
        }

        if(empty($data['body'])){
            $data['body_err'] = 'please enter body text';
        }

        //make sur no error
        if(empty($data['body_err']) && empty($data['title_err'])){

            //validated
            //die('validaztion');
            if($this->postModel->addPost($data)){
                flash('post_message','post added with success');
                redirect('post');
            }else{
                die('somrthing with wrong');
            }

        }else{
            //load view eurror
            $this->view('posts/add',$data);
        }


        }else{

            $data = [
                'titlePage'=>'Add Post',
                'body'=> ''
            ];
            $this->view('posts/add',$data);

        }

    }


}