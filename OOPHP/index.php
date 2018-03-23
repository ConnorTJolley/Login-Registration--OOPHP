<?php



session_start();

include 'resources/class_lib.php';

if(isset($_SESSION["Logged_In"]))
{
  if($_SESSION["Logged_In"] == "True")
  {
    //Redirect them to the welcome / account page as they are logged in
    header("Location: welcome.php");
  }
  else
  {
    //Let them use the form on this page as they aren't logged in
  }
}

if(isset($_REQUEST["submit"]))
{
  //Get and store values from form in variables
  $Full_Name = $_REQUEST["Full_Name"];
  $Password = $_REQUEST["Password"];
  
  //Upload the Full Name
  $User = new person($Full_Name);
  
  //$User->email = $Email; //($Email);
  $User->set_password($Password);
  
  //Create the user in the database
  print_r($User->name);
  $User->createAccount();
}
else
{
  //Don't do anything as you need to wait for form to be submitted
}
?>

<form method="POST" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
  <label>Full Name: </label><input type="text" name="Full_Name" placeholder="Bob Frank">
  <label>Password: </label><input type="password" name="Password" placeholder="123456678">
  <input type="submit" name="submit" value="Submit!">
</form>
