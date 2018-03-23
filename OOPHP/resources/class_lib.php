<?php

class person 
{
  //Create the class variables
  var $name;  
  var $Password;
  
  //Function to create the person with the person name passed across
  function __construct($persons_name)
  {  
     $this->name = $persons_name;  
  }       

  function set_password($Password)
  {
    //Use sha1 and salt for password encryption then store in the class for Person
    $salt = "$2y$10$2n0RmozQeNalwMbS9unKMOZNryBv.8gW8jrTOybs3TpQUSvdYaDOe";
    $phash = sha1($salt.$Password); 
    //Set Password
    $this->password = $phash; 
  }
  
  //Create the account and store it in the database
  function createAccount()
  {
    include 'dbconnect.php';
    $A_Level = "U";
    $stmt = $conn->prepare("INSERT INTO accs (Username, Password, User_Level) VALUES (?,?,?)");
    //Bind the $User->name, password and access level into the SQL statement
    $stmt->bind_param("sss", $this->name, $this->password, $A_Level);
    $result = $stmt->execute();
    //If it was successful, create sessions and log them in and redirect
    if($result === TRUE)
    {
      $_SESSION["Logged_In"] = "True";
      $_SESSION["Username"] = $this->name;
      $_SESSION["A_Level"] = $A_Level;
      header("Location: welcome.php");
    }
    else //If it wasn't then set logged in to false and redirect
    {
      $_SESSION["Logged_In"] = "False";
      header("Location: index.php");
    }
  }       
} 
 

  
?>