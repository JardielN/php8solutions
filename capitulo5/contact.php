<!DOCTYPE HTML>
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
include './includes/title.php'; 
$errors = [];
$missing = [];

// check if the form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // email processing script
    $to = 'cesarr13468@gmail.com';
    $subject = 'Feedback from Japan Journey';
    // list expected fields
    $expected = ['name', 'email', 'comments', 'subscribe', 'interests'];
    // set required fields
    $required = ['name', 'comments', 'email', 'subscribe', 'interests'];
    // set default values for variables that might not exist
    if(!isset($_POST['subscribe']))
    {
        $_POST['subscribe'] = '';
    }
    if(!isset($_POST['interests']))
    {
        $_POST['interests'] = [];
    }
    // Minimum number of required check boxes
    $minCheckboxes = 1;
    if(count($_POST['interests']) < $minCheckboxes)
    {
        $errors['interests'] = true;
    }
    // Create additional headers
    $headers['From'] = 'Japan Journey<Japan@journey.com>';
    $headers['Content-Type'] = 'text/plain; charset=utf-8';
    require './includes/processmail.php';
    if($mailSent)
    {
        header('Location: http://localhost/php8solutions/capitulo5/thank_you.php');
        exit;
    }

    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jardielnruiz@gmail.com';                     //SMTP username
    $mail->Password   = 'ndgy soee jvna dtjm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('jardielnruiz@gmail.com', 'Jardiel Nematini');
    $mail->addAddress($to, 'Usuario');     //Add a recipient
     //Attachments
    $mail->addAttachment('testingjapan.jpg', 'Testing Japan');    //Optional name


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $headers['From'];
    $mail->Body    = $message;

    $mail->send();
    header('Location: http://localhost/php8solutions/capitulo5/thank_you.php');
    exit;

}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Japan Journey <?php if (isset($title)) {echo "&mdash; {$title}";}?></title>
    <link href="styles/journey.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <h1>Japan Journey </h1>
</header>
<div id="wrapper">
    <?php require './includes/menu.php'; ?>
    <main>
        <h2>Contact Us  </h2>
        <?php if(($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
            <p class="warning">Sorry, your mail could not be sent.</p>
            <p>Please try later.</p>
        <?php } elseif($missing || $errors) { ?>
            <p class="warning">Please fix the item(s) indicated.</p>
        <?php }?>
        <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
        <form method="post" action="contact.php">
            <p>
                <label for="name">Name:
                    <?php if(in_array('name', $missing))  { ?>
                        <span class="warning">Please enter your name</span>
                    <?php }?>
                </label>
                <input name="name" id="name" type="text"
                <?php if($missing || $errors) {
                    echo 'value="' . htmlentities($name) . '"';
                }?>>
            </p>
            <p>
                <label for="email">Email:
                    <?php if(in_array('email', $missing))  { ?>
                        <span class="warning">Please enter your email</span>
                    <?php } elseif(isset($errors['email'])) { ?>
                        <span class="warning">Invalid email address</span>
                    <?php } ?>
                </label>
                <input name="email" id="email" type="text"
                <?php if($missing || $errors) {
                    echo 'value="' . htmlentities($email) . '"';
                }?>>
            </p>
            <p>
                <label for="comments">Comments:
                    <?php if(in_array('comments', $missing)) {?>
                        <span class="warning">Please enter your comments</span>
                    <?php }?>
                </label>
                <textarea name="comments" id="comments"><?php if($missing || $errors){
                    echo htmlentities($comments);
                }?></textarea>
            </p>
            <p>
                <fieldset id="subscribe">
                    <h2>Subscribe to newsletter?</h2>
                    <?php if(in_array('subscribe', $missing)) {?>
                        <span class="warning">Please make a selection</span>
                    <?php } ?>
                    <p>
                        <input type="radio" name="subscribe" value="Yes" id="subscribe-yes"
                        <?php
                        if($_POST && $_POST['subscribe'] == 'Yes')
                        {
                            echo 'checked';
                        }
                        ?>>
                        <label for="subscribe-yes">Yes</label>
                                            <input type="radio" name="subscribe" value="No" id="subscribe-no"
                    <?php
                    if($_POST && $_POST['subscribe'] == 'No')
                    {
                        echo 'checked';
                    }
                    ?>>
                    <label for="subscribe-no">No</label>
                    </p>
                </fieldset>
            </p>
            <p>
                <fieldset id="interests">
                    <h2>Interests in Japan
                        <?php
                        if(isset($errors['interests'])) {?>
                        <span class="warning">Please select at least <?= $minCheckboxes ?></span>
                        <?php } ?>
                    </h2>
                    <div>
                        <p>
                            <input type="checkbox" name="interests[]" value="Anime/manga" id="anime"
                            <?php 
                            if($_POST && in_array('Anime/manga', $_POST['interests']))
                            {
                                echo 'checked';
                            }
                            ?>>
                            <label for="anime">Anime/manga</label>
                        </p>
                        <p>
                            <input type="checkbox" name="interests[]" value="Arts & crafts" id="art"
                            <?php
                            if($_POST && in_array('Arts & crafts', $_POST['interests']))
                            {
                                echo 'checked';
                            }
                            ?>>
                            <label for="art">Arts & crafts</label>
                        </p>
                        <p>
                            <input type="checkbox" name="interests[]" value="Judo, Karate, etc." id="judo"
                            <?php
                            if($_POST && in_array('Judo, Karate, etc.', $_POST['interests']))
                            {
                                echo 'checked';
                            }
                            ?>>
                            <label for="judo">Judo, Karate, etc.</label>
                        </p>
                    </div>
                    <div>
                    <p>
                        <input type="checkbox" name="interests[]" value="Language/literature" id="lang_lit"
                        <?php
                        if($_POST && in_array('Language/literature', $_POST['interests']))
                        {
                            echo 'checked';
                        }
                        ?>>
                        <label for="lang_lit">Language/literature</label>
                    </p>
                    <p>
                        <input type="checkbox" name="interests[]" value="Science & technology" id="scitech"
                        <?php
                        if($_POST && in_array('Sciencie & technology', $_POST['interests']))
                        {
                            echo 'checked';
                        }
                        ?>>
                        <label for="schitech">Science & technology</label>
                    </p>
                    <p>
                        <input type="checkbox" name="interests[]" value="Travel" id="travel"
                        <?php
                        if($_POST && in_array('Travel', $_POST['interests']))
                        {
                            echo 'checked';
                        }
                        ?>>
                        <label for="travel">Travel</label>
                    </p>
                    </div>
                </fieldset>
            </p>
            <p>
                <label for="howhear">How did you hear of Japan Journey?</label>
                <select name="howhear" id="howhear">
                    <option value=""
                    <?php
                    if(!$_POST || $_POST['howhear'] == '')
                    {
                        echo 'selected';
                    }
                    ?>>Select one</option>
                    <option value="Apress"
                    <?php
                    if($_POST && $_POST['howhear'] == 'Apress')
                    {
                        echo 'selected';
                    }
                    ?>>Apress</option>
                    <option value="recommended by a friend"
                    <?php
                    if($_POST && $_POST['howhear'] == 'recommended by a friend')
                    {
                        echo 'selected';
                    }
                    ?>>Recommended by a friend</option>
                    <option value="search engine"
                    <?php
                    if($_POST && $_POST['howhear'] == 'search engine')
                    {
                        echo 'selected';
                    }
                    ?>>Search engine</option>
                </select>
            </p>
            <p>
                <input name="send" type="submit" value="Send message">
            </p>
        </form>
    </main>
    <?php include './includes/footer.php'; ?>
</div>
</body>
</html>
