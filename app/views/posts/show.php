<?php 
ob_start()
?>
    <a href="<?= URLROOT ?>/posts"><i class="fa fa-backward"></i> back</a>
<h1><?= $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?= $data['user']->name ?> on <?= $data['post']->created_at ?>
</div>

<p><?= $data['post']->body ?></p>

<?php if($data['post']->user_id == $_SESSION['user_id']): ?>
    <a href="<?= URLROOT ?>/posts/edit/<?= $data['post']->id ?>" class="btn btn-dark">edit</a>

    <form action="<?= URLROOT ?>/posts/delete/<?= $data['post']->id ?>" method="POST" class="d-inline pull-right">
        <input type="submit" class="btn btn-danger d-inline " value="delete">
    </form>


    
<?php endif ?>    



<?php 
$content =ob_get_clean();
$titre = $data['titlePage'] ;
$description = $data['description'];
require APPROOT."/views/inc/template.html.php";
?>