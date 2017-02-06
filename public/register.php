<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      //Write SQL INSERT statement

?>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Globitek Corp.</h1>
  <p>Register to become a Globitek Partner.</p>

<?php
  $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
  $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $username = isset($_POST['username']) ? $_POST['username'] : '';

?>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    $errors = [];
    if(is_post_request()){
    if(empty($first_name)) {
      $errors[] = "Enter a first name.";
    }
    else if(!has_length($first_name, ['min' => 2, 'max' => 255])){
      $errors[] = "Enter a first name between 2-255 characters.";
    }


    if(empty($last_name)) {
      $errors[] = "Enter a last name.";
    }
    else if(!has_length($last_name, ['min' => 2, 'max' => 255])){
      $errors[] = "Enter a last name between 2-255 characters.";
    }


    if(empty($email)) {
      $errors[] = "Enter an email.";
    }
    else if(!has_length($email, ['min' => 0, 'max' => 255])){
      $errors[] = "Enter an email less than 255 characters.";
    }
    else if(!has_valid_email_format($email)){
      $errors[] = "Enter a valid email.";
    }
    

    if(empty($username)) {
      $errors[] = "Enter an user name.";
    }
    else if(!has_length($username, ['min' => 8, 'max' => 255])){
      $errors[] = "Enter a username between 8-255 characters.";
    }
    display_errors($errors);

    if(is_post_request() && (empty($errors))) {
      //sanitize before outputting to the db
      sanitize_string($first_name);
      sanitize_string($last_name);
      sanitize_email($email);
      sanitize_string($username);

      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at)
      VALUES ('$first_name', '$last_name', '$email', '$username', NOW());";

      //For INSERT statments, $result is just true/false
      $result = db_query($db, $sql);
      if($result) {
          redirect_to('registration_success.php');
          db_close($db);
      }
      else {
        // The SQL INSERT statement failed.
        // Just show the error, not the form
        echo db_error($db);
        db_close($db);
        exit;
      }
    }
  }
  ?>

  <!-- TODO: HTML form goes here -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  First name<br>
  <input type="text" name="first_name" value="<?php echo $first_name; ?>"><br>
  Last name<br>
  <input type="text" name="last_name" value="<?php echo $last_name; ?>"><br>
  Email address<br>
  <input type="text" name="email" value="<?php echo $email; ?>"><br>
  Username<br>
  <input type="text" name="username" value="<?php echo $username; ?>"><br><br>
  <input type="submit" name="submit" value="Submit"><br><br>


</form>
</div>
</head>
<?php include(SHARED_PATH . '/footer.php'); ?>
