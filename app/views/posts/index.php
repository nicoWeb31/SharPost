<?php 
ob_start();
flash('post_message');
?>



<div class="row mb-3">
    <div class="col-6">
        <h1>Post</h1>
    </div>
    <div class="col-6">
        <a href="<?= URLROOT ?>/posts/add" class="btn btn-primary">
            <i class="fa fa-pencil"></i>add post    
        </a>
    </div>
</div>
<?php foreach($data['posts'] as $post): ?>


    <div class="card card-body mb-3">
        <h4 class="card-title"><?= $post->title ?></h4>
        <div class="bg-ligth p-2 mb-3">
            written by <?= $post->name ?> on <?= $post->postDate ?>
        </div>
        <p class="card-text"><?= $post->body ?></p>
        <a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>" class="btn btn-dark">show</a>
    </div>
<?php endforeach ?>


<?php 
$content =ob_get_clean();
$titre = $data['title'] ;
$description = $data['description'];
require APPROOT."/views/inc/template.html.php";
?>