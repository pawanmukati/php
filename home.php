<?php
    session_start();
    if(!isset($_SESSION['username'])){
      echo '<span class="text-danger"  >You are logged out</span>';
      header('location:login.php');

    }
    
  ?>


