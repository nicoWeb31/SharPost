<?php 



class Pages extends Controller
{
    public function __construct()
    {
        // echo 'Pages loaded';

    }

    public function index(){

        $data = ['title' =>'welcome',
        'description' =>'Simùple social network build on the TraversMvc php Framwork'
        ];

        $this->view('pages/index',$data);
    }


    public function about()

    {
        $data = [
        'title' =>'about',
        'description' => 'App to share post with other users'    ];
        $this->view('pages/about',$data);   
    }

}