<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type="text/css" href="css/style.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcBb6MkAAAAACjBfCg5S_aVtsN9Jh__Yc8fzFU2"></script>
    <script>
    
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcBb6MkAAAAACjBfCg5S_aVtsN9Jh__Yc8fzFU2', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
            var response = document.getElementById('token_response');
            response.value= token;
            });
        });
    
    </script>
</head>
<body>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token_response'])){
    $url='https://www.google.com/recaptcha/api/siteverify';
    $secret= '6LcBb6MkAAAAAAOwRK-l2qoDVU1ePuMUY1ziDBHU';
    $recaptcha_response=$_POST['token_response'];

    $request = file_get_contents($url . '?secret=' . $secret . '&response=' . $recaptcha_response);
    $response = json_decode($request);

    if($response->success==true && $response->score>= 0.5){

        echo '<script language = "javascript">';
        echo 'alert("Thank You For Contacting Us")';
        echo '</script>';
        echo " <script>setTimeout(\"location.href='index.php';\",00);
        </script>";
    }
        else{
            echo '<script language = "javascript">';
        echo 'alert("Please enter correct Captcha")';
        echo '</script>';
        echo "

        <script>setTimeout(\"location.href='index.php';\",00);
        </script>";

        }
    }

?>
<?php
    if(!empty($_POST["send"])){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $gender= $_POST["gender"];
        $country= $_POST["country"];
        $addInfo = $_POST["addInfo"];
        $toEmail = "poojag102002@gmail.com";

        $mailHeaders = "First Name: " . $fname . 
        "\r\n Last Name: ". $lname .
        "\r\n Email: " . $email . 
        "\r\n Gender: " . $gender . 
        "\r\n Country: " . $country . 
        "\r\n addInfo: " . $addInfo . "\r\n";

        if(mail($toEmail,$fname,$mailHeaders)){
            $message = "Your information is received successfully";
        }


    }
    ?>
    <div class="contact-box">

        <form method="post" name="emailContact">
            <input type="hidden" id= "token_response" name= "token_response">
            <label> First Name:<em>*</em></label>  
            <input id="fname" name="fname" placeholder="Jane" class="input-field" required /> <br>  <br>

            <label> Last Name:<em>*</em> </label>  
            <input id="lname" name="lname" placeholder="Doe" class="input-field" required /> <br>  <br>

            <label> Email:<em>*</em> </label>  
            <input id="email" name="email" placeholder="JaneDoe@gmail.com" class="input-field" required /> <br>  <br>

            <label> Gender: </label>  <br>
            <input type="radio" class="rdbtn" id="male" name="gender" value="Male"> <span>Male</span>
            <input type="radio" class="rdbtn" id="female" name="gender" value="Female"> <span>Female</span>
            <input type="radio" class="rdbtn" id="Other" name="gender" value="Other"> <span>Other</span>  <br> <br>

            <label for="country" >Country of Residence:  </label> 
            <select name="country" id="country" class="input-field">
                    <option value="india">India</option>
                    <option value="japan">Japan</option>
                    <option value="ireland">Ireland</option>
                    <option value="australia">Australia</option>
            </select> <br> <br>

            <label>Additional Information:<em>*</em> </label>
                    <textarea name="addInfo" class="input-field" required></textarea> <br> <br>

            <div class ="input-row">
                <input type="submit" value="Submit" />

                <?php 
                if(!empty($message)){ ?>
                <div class="success">
                    <strong><?php echo $message; ?></strong>
                </div>
                <?php } ?>
            </div>
        </form>
    </div>
</body>
</html>

