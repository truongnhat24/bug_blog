<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BUG BLOG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Test ">
    <meta name="author" content="pacificsoftdev@gmail.com">
    <link rel="icon" type="image/x-icon" href="media/img/favicon.png">

    <!-- Bootstrap core CSS -->
	<link href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo RootREL; ?>media/css/main.css" rel="stylesheet">
	<?php echo html_helpers::cssHeader(); ?>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md navbar-info fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-warning" href="#">BUGBLOG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="<?php echo html_helpers::url('/'); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="<?php echo html_helpers::url(['ctl'=>'about']); ?>">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="<?php echo html_helpers::url(['ctl'=>'blogs']); ?>">Blogs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="<?php echo html_helpers::url(['ctl'=>'contact']); ?>">Contact us</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <div class="btn-login-group me-3 ms-5 d-flex align-items-center">
          <?php if ($_SESSION) {?>     
            <span class="me-2 text-light d-block"> 
              welcome, 
              <a class="text-warning" href="<?php echo html_helpers::url(['ctl'=>'users']); ?>"><?php echo $_SESSION['name'] ?></a>
            </span>       
            <a href="<?php echo html_helpers::url(['ctl'=>'users', 'act'=>'logout']); ?>" class="btn btn-custom-auth text-light">Logout</a>
          <?php } else {?>          
            <a href="<?php echo html_helpers::url(['ctl'=>'users', 'act'=>'login']); ?>" class="btn btn-custom-auth text-light">Login</a>
            <a href="<?php echo html_helpers::url(['ctl'=>'users', 'act'=>'signup']); ?>" class="btn btn-custom-auth text-light ms-2">Sign up</a>
          <?php } ?>
        </div>
      </div>
    </div>
  </nav>
</header>
<main>
  <div class="container">
