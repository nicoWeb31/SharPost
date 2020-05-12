<?php 
ob_start()
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create an account</h2>
            <p>please fill out this form to register with us</p>
            <form action="<?= URLROOT ?>/users/register" method="POST">
                <div class="form-group">
                    <label for="name">Name : <sup>*</sup> </label>
                    <input type="text" name="name" class="form-control form-control-lg <?= !(empty($data['name_err'])) ? 'is-invalid' : '' ?>" 
                    value="<?= $data['name']?> ">
                    <span class="ivalid-feesback"><?= $data['name_err']?></span>
                </div>
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
                <div class="form-group">
                    <label for="confirm_password">Confirm Password : <sup>*</sup> </label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?= !(empty($data['confirm_password_err'])) ? 'is-invalid' : '' ?>" 
                    value="<?= $data['confirm_password']?> ">
                    <span class="ivalid-feesback"><?= $data['confirm_password_err']?></span>
                </div>
               
                <div class="row">
                    <div class="col">
                        <input type="submit" value="register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT ?>/users/login" class="btn btn-ligth btn-block"> have un account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php 
$content =ob_get_clean();
$titre = $data['title'] ;
$description = $data['description'];
require APPROOT."/views/inc/template.html.php";
?>