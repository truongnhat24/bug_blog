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
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">BUGBLOG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo html_helpers::url('/'); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo html_helpers::url(['ctl'=>'about']); ?>">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo html_helpers::url(['ctl'=>'blogs']); ?>">Blogs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo html_helpers::url(['ctl'=>'contact']); ?>">Contact us</a>
          </li>
          <!-- <?php $test = 1;
          if ($test == 1 )
            { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo html_helpers::url(['ctl'=>'students']); ?>">Concar</a>
              </li>
            <?php } ?> -->
        
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>
<main>
  <div class="container">
