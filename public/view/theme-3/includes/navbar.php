<?php

include_once __DIR__.'/../../../model/users.class.php';

$navdata = new Users();
$result = $navdata->ReadSingleUser('u_id', 1);
$row = $result->fetch_assoc();

?>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index" style="font-style: italic;font-weight: 500;"><?= $row['u_name']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?= ROOT_URL_WEBSITE; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="postlist">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= ROOT_URL_ADMIN; ?>" target="_blank">Login</a>
        </li>
      </ul>
      <!-- Search Field -->
    <form action="searchPost" method="post" class="form-inline">
      <div class="nav-search mb-0">
          <div class="nav-search-inner">
              <i class="fa fa-search"></i>
              <input type="text" name="search" placeholder="Search" autocomplete="off" class="pt-0">
              <button type="submit" class="d-none btn btn-dark btn-block rounded-0" name="submit">Go</button>
          </div>
      </div>
    </form>
  </div>
  </div>
</nav>
