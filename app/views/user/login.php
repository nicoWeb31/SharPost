<?php 
ob_start()
?>


<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_sucess') ;?>
            <h2>Login</h2>
            <p>please fill in your credetials to login</p>
            <form action="<?= URLROOT ?>/users/login" method="POST">
                <div class="form-group">
                    <label for="email">Email : <sup>*</sup> </label>
                    <input type="emaili" name="email" class="form-control form-control-lg <?= !(empty($data['email_err'])) ? 'is-invalid' : '' ?>" 
                    value="<?= $data['email']?> ">
                    <span class="ivalid-feesback"><?= $data['email_err']?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password : <sup>*</sup> </label>
                    <input type="password" name="password" class="form-control form-control-lg <?= !(empty($data['password_err'])) ? 'is-invalid' : '' ?>" 
                    value="<?= $data['password']?> ">
                    <span class="ivalid-feesback"><?= $data['password_err']?></span>
                </div>
            
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT ?>/users/register" class="btn btn-ligth btn-block"> you don't have un account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<?php 
$content =ob_get_clean();
$titre = $data['title'] ;
// $description = $data['description'];
require APPROOT."/views/inc/template.html.php";
?>