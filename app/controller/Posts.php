<?php 
class Posts extends Controller {


    private $postModel;
    private $userModel;



    public function __construct()
    {

        //load model
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');


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


    //show one 
    public function show($id){

        $post = $this->postModel->getPostById($id);
        // var_dump($post);
        $user = $this->userModel->getUserByid($post->user_id);
        // var_dump($user);


        $data = [
            'titlePage'=>'show one post',
            'post'=>$post,
            'user' => $user
        ];
        $this->view('posts/show',$data);
    }


    //methode verbe url
    public function edit($id){

        // die('vue');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post array
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'user_id'=> $_SESSION['user_id'],
                'title_err'=> '',
                'body_err'=> '',
                //id du param
                'id'=>$id
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
            if($this->postModel->updatePost($data)){
                flash('post_message','post update with success');
                redirect('post');
            }else{
                die('something went wrong');
            }

        }else{
            //load view eurror
            $this->view('posts/edit',$data);
        }


        }else{
            //die('test condition');
            //get existing post from model
            $post  = $this->postModel->getPostById($id);
            var_dump($post);


            //chek for owner
            if($post->user_id !== $_SESSION['user_id']){
                redirect('posts');
            }


            $data = [
                'id'=>$id,
                'titlePage'=>'Edit post',
                'title'=>$post->title,
                'body'=> $post->body
            ];
            $this->view('posts/edit',$data);

        }

    }

    //methode verbe url
    public function delete($id){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //chek for owner
            $post  = $this->postModel->getPostById($id);
            if($post->user_id !== $_SESSION['user_id']){
                redirect('posts');
            }

            if($this->postModel->deletePost($id)){
                flash('post_message','post removed with success');
                redirect('posts');
            }else{
                die('something went wrong');
            }

        }else{
            redirect('posts');
        }
    }



}