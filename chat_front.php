<?php
session_start();
function chat_front()
{
    ?>
    <button class="open-button" onclick="openForm()">Chat<span id="notifiy" style="background: #993300;float: right;font-size: 10px; display: none">New</span></button>

    <div class="chat-popup" id="myForm">
    <?php
    function loginForm()
    {
        echo '
    <div id="loginform">
    <form action="" method="post">
        <p>Please enter your name to continue:</p>
        <label for="name">Name:</label>
        <input type="text" name="cname" id="cname" /><br><br>
        <label for="email">Email:</label>
        <input type="text" name="em" id="em" /><br><br>
        <input type="submit" name="enter" id="enter" value="Enter" style="width: 100%; margin: 1px;"/>
    </form>
    </div>
    ';
    }
    $user_cid = "<script>document.write(sessionStorage.getItem('cid'));</script>";
    //echo 'test'.$user_cid;
    //var_dump($user_cid);
    if (isset($_POST['enter'])) {
        if ($_POST['cname'] != "" && $_POST['em'] != "" && preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_POST['em'])) {
            $_SESSION['cname'] = stripslashes(htmlspecialchars($_POST['cname']));
        } else {
            echo '<span class="error">Please type in a name and a valid email</span>';
        }
        echo '<script>document.getElementById("myForm").style.display = "block";</script>';
    }

    if (isset($_SESSION['cname'])) {
        ?>

        <div id="wrapper" class="chatform">
            <div id="menu">
                <p class="welcome">Welcome, <b><?php echo $_SESSION['cname']; ?></b></p>
<!--                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>-->
                <div style="clear:both"></div>
            </div>

            <div id="chatbox" style="height: 200px; overflow-y: scroll"></div>

            <form name="message" action="">
                <input type="hidden" name="cid" id="cid" value="">
                <input name="usermsg" type="text" id="usermsg" size="30" style="margin: 5px"/>
<!--                <input name="submitmsg" type="submit" id="submitmsg" value="Send"/>-->

            </form>
            <button id="snd" type="button" class="btn" style="width: 100%; margin: 1px;"  >SEND</button>
        </div>

        <?php
    } else {
        loginForm();
    }
    ?>
        <button type="button" class="btn cancel" onclick="closeForm()" style="width: 100%; margin: 1px;">Close</button>

    </div>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        /* Button used to open the chat form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
            background: white;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width textarea */
        .form-container textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            resize: none;
            min-height: 200px;
        }

        /* When the textarea gets focus, do something */
        .form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .form-container .btn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }
    </style>
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";

            var id=jQuery('#cid').val();
            //alert(id);
            var data = {
                'action': 'update_chat',
                'cid': id
            };
            jQuery.post(ajax_object.ajaxurl, data, function(response) {
                //alert(response);
                jQuery('#notifiy').css('display','none');

            });

            setTimeout(function(){jQuery("#chatbox").animate({ scrollTop: $('#chatbox').prop("scrollHeight")}, 0);},3000);

        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
        <?php
}
add_shortcode('short_chat_front', 'chat_front');
add_action( 'wp_footer', 'chat_front' );