<?php 
ob_start()
?>


    <a href="<?= URLROOT ?>/posts"><i class="fa fa-backward"></i> back</a>
        <div class="card card-body bg-light mt-5">
  
            <h2>Edit post</h2>
            <p>edit this  post </p>
            <form action="<?= URLROOT ?>/posts/edit/<?= $data['id']?>" method="POST">
                <div class="form-group">
                    <label for="email">Title : <sup>*</sup> </label>
                    <input type="text" name="title" class="form-control form-control-lg <?= !(empty($data['title_err'])) ? 'is-invalid' : '' ?>" 
                    value="<?= $data['title']?> ">
                    <span class="ivalid-feesback"><?= $data['title_err']?></span>
                </div>
                <div class="form-group">
                    <label for="body">Text : <sup>*</sup> </label>
                    <textarea type="text" name="body" class="form-control form-control-lg <?= !(empty($data['body_err'])) ? 'is-invalid' : '' ?>"><?= $data['body']?></textarea>
                    <span class="ivalid-feesback"><?= $data['body_err']?></span>
                </div>
                <input type="submit" value="submit" class="btn btn-success">
            
            </form>
        </div>




<?php 
$content =ob_get_clean();
$titre = $data['titlePage'] ;
$description = $data['description'];
require APPROOT."/views/inc/template.html.php";
?>