

<?php
  $captcha;
    if (isset($_POST['g-recaptcha-response'])) { $captcha = $_POST['g-recaptcha-response']; }
  // Check for correct reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdvhUUUAAAAAGfcqknpX0WbWyVgbzRFPp-pn4ct&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    if (!$captcha || $response.success == false) {
        echo "Your CAPTCHA response was wrong";
        exit ;
      } else {
        // Check for Blank Fields..
        if ($_POST["vname"] == "" || $_POST["vemail"] == "" || $_POST["msg"] == "") {
    echo "Please fill all required fields";
else
} else {
    // Check if the "Sender's Email" input field is filled out
    $email = $_POST['vemail'];
    // Sanitize E-mail Address
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate E-mail Address
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo "Invalid Sender's Email";
    } else {
        $to = 'therealcatsdgs@gmail.com';
        $subject = 'New Form Entry';
        $message = "New message was submitted from <br /> " . "<strong>" . $_POST['vname'] . "</strong>" . "<br /><br />The message is:<br />" . "<strong>" . $_POST['msg'] . "</strong>";
        $headers = "From:" . $_POST['vname'] . "<" . $email . ">";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // Sender's Email
        // Message lines should not exceed 70 characters (PHP rule), so wrap it
        $message = wordwrap($message, 70, "\r\n");
        // Send Mail By PHP Mail Function
        if (mail($to, $subject, $message, $headers)) {
            echo "Message Sent"; #this is correct one
        } else {
            header("Location: https://google.com");
            exit ;
        }
    }
}
}
?>
