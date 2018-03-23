<?php

session_start();

include 'resources/class_lib.php';

if(isset($_SESSION["Logged_In"]))
{
  if($_SESSION["Logged_In"] == "True")
  {
    //Let them continue
    print_r("Welcome: " . $_SESSION["Username"]);
  }
  else
  {
    //Redirect to login form
    header("Location: index.php");
  }
}
else
{
  //Redirect to login form
  header("Location: index.php");
}
?>