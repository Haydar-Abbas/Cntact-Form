<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $user   = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
  $email  = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $phone  = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
  $msg    = filter_var($_POST['msg'], FILTER_SANITIZE_SPECIAL_CHARS);

  $msg_error = array();

  if (strlen($user) > 20) {
    
    $msg_error[] = "This Name is Larger Than 20 Character!";
  }
  if (strlen($phone) > 11) {
    $msg_error[] = "This Number is Large!";
  }
  if (strlen($msg) > 50) {
    $msg_error[] = "This Message is Larger Than 50 Character!";
  }

  $to = "haydarbigo@mail.com";
  $subject = "Contact Form";
  $headers = "From:" . $email . "\r\n";

  if(empty($msg_error)) {

    mail($to, $subject, $msg, $headers);

    $user  = '';
    $email = '';
    $phone = '';
    $msg   = '';

    $succsess = "<div class='alert alert-success'>We Have Recieved Your Message!</div>";
  }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Render All Elemant Normally -->
  <link rel="stylesheet" href="css/normalize.css">
    <!-- Min Template BootStrap V5.1 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome Library -->
  <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- Template Main File Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Contact Form</title>
</head>
<body>
  <!-- Start Form -->

  <div class="container">

    <h1>Contact Me</h1>
    <?php   // ========== Display Errors ==========
      if(! empty($msg_error)) { 
    ?>
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <?php
            foreach($msg_error as $error){
              echo $error;
            }
          ?>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    <?php
      }
    ?>
    <?php   //  Display Alert Success When Recieved a Message
     if(isset($succsess)) { echo $succsess;}
    ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="contact-form">

      <div class="form-group">
        <input class="form-control" type="text" name="username" placeholder="UserName" value="<?php if(isset($user)){echo $user;}?>">
        <span class="asterisk">*</span>
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email" value="<?php if(isset($email)){echo $email;}?>">
        <span class="asterisk">*</span>
      </div>
      <div>
        <input class="form-control" type="text" name="phone" placeholder="Phone" value="<?php if(isset($phone)){echo $phone;}?>">
      </div>
      <div class="form-group">
        <textarea class="form-control" name="msg" placeholder="Your Message..."><?php if(isset($msg)){echo $msg;}?></textarea>
        <span class="asterisk">*</span>
      </div>

      <input class="btn btn-success" type="submit" value="Send Message">

    </form>

  </div>

  <!-- End Form -->


  <script src="js/all.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
