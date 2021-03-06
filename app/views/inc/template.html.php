<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    
      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= URLROOT ?>/pages/index"><?= SITNAME ?> <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/pages/about">About</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="#">Welcome <?= $_SESSION['user_name']?> </a>
            </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/users/logout">Logout</a>
          </li>

          <?php else : ?>

          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/users/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URLROOT ?>/users/login">Login</a>
          </li>
          <?php endif  ?>

        </ul>
    
      </div>
    </nav>




<div class="container ">

<div class="jumbotron jumotron-fluid text-center mt-3">
    <div class="container">
        <h1><?= $titre ?></h1>
        <p class="lead"><?= $description ?></p>
        <p class="lead">Version : <?= APPVERSION ?></p>

    </div>
</div>


<?= $content ?>

</div>





<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>