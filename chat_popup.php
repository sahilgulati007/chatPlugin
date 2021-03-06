<?php
function chat_popup()
{
    ?>
    <div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="material-icons">speaker_phone</i>
        <i class="material-icons" style="color: red" id="notifiy">notification_important</i>
    </div>

    <div class="chat-box">
        <div class="chat-box-header">
            ChatBot
            <span class="chat-box-toggle-close"><i class="material-icons">close</i></span>
            <span class="chat-box-toggle"><i class="material-icons">minimize</i></span>
        </div>
        <div id="loginform">
            <form action="" method="post">
                <p><b>Please enter your name and Email to continue:</b></p>
                <p style="color: red;" id="invalidem">Enter a valid email and name </p>

                <input type="text" name="cname" id="cname" placeholder="Enter Name" style="width: 97%;" /><br><br>

                <input type="text" name="em" id="em" placeholder="Enter Email" style="width: 97%;" /><br><br>
                <input type="button" name="enter" id="enter" value="Enter" style="width: 100%; margin: 1px;background:#5A5EB9;background-color: #5A5EB9 !important;border-bottom-color: #5A5EB9 !important;color: #fff !important; "/>
            </form>
        </div>
        <div class="chat-box-body">
            <div class="chat-box-overlay">
            </div>
            <div class="chat-logs">

            </div><!--chat-log -->
        </div>
        <div style="background: transparent" id="upload_div">
            <input type="file" id="file_upload" value="Attachment" class="btn" style="margin: 1px; display: none" >
            <button type="button" class="photo-submit" id="upfile1"><i class="material-icons">photo_camera</i></button>
            <button type="button" class="photo-submit" id="upfile2"><i class="material-icons">attach_file</i></button>
        </div>
        <div class="chat-input">
            <form>
                <input type="hidden" id="cid" value="">
                <input type="text" id="usermsg" placeholder="Send a message..."/>
                <button type="button" class="chat-submit" id="snd"><i class="material-icons">send</i></button>
            </form>
        </div>

    </div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        #invalidem{
            display: none;
        }
        html, body {
            background: #efefef;
            height:100%;
        }
        #center-text {
            display: flex;
            flex: 1;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            height:100%;

        }
        #chat-circle {
            position: fixed;
            bottom: 50px;
            right: 50px;
            background: #5A5EB9;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            box-sizing: border-box;
            color: white;
            padding: 28px;
            cursor: pointer;
            box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .btn#my-btn {
            background: white;
            padding-top: 13px;
            padding-bottom: 12px;
            border-radius: 45px;
            padding-right: 40px;
            padding-left: 40px;
            color: #5865C3;
        }
        #chat-overlay {
            background: rgba(255,255,255,0.1);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            display: none;
        }


        .chat-box {
            display:none;
            background: #efefef;
            position:fixed;
            right:30px;
            bottom:50px;
            width:350px;
            max-width: 85vw;
            max-height:100vh;
            border-radius:5px;
            /*   box-shadow: 0px 5px 35px 9px #464a92; */
            box-shadow: 0px 5px 35px 9px #ccc;
        }
        .chat-box-toggle {
            float:right;
            margin-right:15px;
            cursor:pointer;
        }
        .chat-box-toggle-close {
            float:right;
            margin-right:15px;
            cursor:pointer;
        }
        .chat-box-header {
            background: #5A5EB9;
            height:70px;
            border-top-left-radius:5px;
            border-top-right-radius:5px;
            color:white;
            text-align:center;
            font-size:20px;
            padding-top:17px;
            box-sizing: border-box;
        }
        .chat-box-body {
            position: relative;
            height:370px;
            height:auto;
            border:1px solid #ccc;
            overflow: hidden;
        }
        .chat-box-body:after {
            content: "";

            opacity: 0.1;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            height:100%;
            position: absolute;
            z-index: -1;
        }
        #chat-input {
            background: #f4f7f9;
            width:100%;
            position:relative;
            height:47px;
            padding-top:10px;
            padding-right:50px;
            padding-bottom:10px;
            padding-left:15px;
            border:none;
            resize:none;
            outline:none;
            border:1px solid #ccc;
            color:#888;
            border-top:none;
            border-bottom-right-radius:5px;
            border-bottom-left-radius:5px;
            overflow:hidden;
        }
        #usermsg {
            background: #f4f7f9;
            width:100%;
            position:relative;
            height:47px;
            padding-top:10px;
            padding-right:50px;
            padding-bottom:10px;
            padding-left:15px;
            border:none;
            resize:none;
            outline:none;
            border:1px solid #ccc;
            color:#888;
            border-top:none;
            border-bottom-right-radius:5px;
            border-bottom-left-radius:5px;
            overflow:hidden;
        }
        .chat-input > form {
            margin-bottom: 0;
        }
        #chat-input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color: #ccc;
        }
        #chat-input::-moz-placeholder { /* Firefox 19+ */
            color: #ccc;
        }
        #chat-input:-ms-input-placeholder { /* IE 10+ */
            color: #ccc;
        }
        #chat-input:-moz-placeholder { /* Firefox 18- */
            color: #ccc;
        }
        button.chat-submit {
            position:absolute;
            bottom:6px;
            right:10px;
            background: transparent;
            box-shadow:none !important;
            border:none;
            border-radius:50% !important;
            color:#5A5EB9 !important;
            width:35px;
            height:35px;
            padding: 0;
        }
        button.photo-submit {
            /*position:absolute;*/
            /*bottom:25px;*/
            /*right:10px;*/
            background: transparent;
            box-shadow:none !important;
            border:none;
            border-radius:50% !important;
            color:#5A5EB9 !important;
            width:35px;
            height:35px;
            padding: 0;
        }
        .chat-logs {
            padding:15px;
            height:370px;
            overflow-y:scroll;
        }

        .chat-logs::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        .chat-logs::-webkit-scrollbar
        {
            width: 5px;
            background-color: #F5F5F5;
        }

        .chat-logs::-webkit-scrollbar-thumb
        {
            background-color: #5A5EB9;
        }



        @media only screen and (max-width: 500px) {
            .chat-logs {
                height:40vh;
            }
        }

        .chat-msg.user > .msg-avatar img {
            width:45px;
            height:45px;
            border-radius:50%;
            float:left;
            width:15%;
        }
        .chat-msg.self > .msg-avatar img {
            width:45px;
            height:45px;
            border-radius:50%;
            float:right;
            width:15%;
        }
        .cm-msg-text {
            background:white;
            padding:10px 15px 10px 15px;
            color:#666;
            max-width:75%;
            float:left;
            margin-left:10px;
            position:relative;
            margin-bottom:20px;
            border-radius:30px;
        }
        .chat-msg {
            clear:both;
        }
        .chat-msg.self > .cm-msg-text {
            float:right;
            margin-right:10px;
            background: #5A5EB9;
            color:white;
        }
        .cm-msg-button>ul>li {
            list-style:none;
            float:left;
            width:50%;
        }
        .cm-msg-button {
            clear: both;
            margin-bottom: 70px;
        }
    </style>
    <script>
        $(function() {
            var INDEX = 0;
            $("#chat-submit").click(function(e) {
                e.preventDefault();
                var msg = $("#chat-input").val();
                if(msg.trim() == ''){
                    return false;
                }
                generate_message(msg, 'self');
                var buttons = [
                    {
                        name: 'Existing User',
                        value: 'existing'
                    },
                    {
                        name: 'New User',
                        value: 'new'
                    }
                ];
                setTimeout(function() {
                    //generate_message(msg, 'user');
                }, 1000)

            })

            function generate_message(msg, type) {
                INDEX++;
                var str="";
                str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg "+type+"\">";
                str += "          <span class=\"msg-avatar\">";
                str += "            <img src=\"https:\/\/image.crisp.im\/avatar\/operator\/196af8cc-f6ad-4ef7-afd1-c45d5231387c\/240\/?1483361727745\">";
                str += "          <\/span>";
                str += "          <div class=\"cm-msg-text\">";
                str += msg;
                str += "          <\/div>";
                str += "        <\/div>";
                $(".chat-logs").append(str);
                $("#cm-msg-"+INDEX).hide().fadeIn(300);
                if(type == 'self'){
                    $("#chat-input").val('');
                }
                $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
            }

            function generate_button_message(msg, buttons){
                /* Buttons should be object array
                  [
                    {
                      name: 'Existing User',
                      value: 'existing'
                    },
                    {
                      name: 'New User',
                      value: 'new'
                    }
                  ]
                */
                INDEX++;
                var btn_obj = buttons.map(function(button) {
                    return  "              <li class=\"button\"><a href=\"javascript:;\" class=\"btn btn-primary chat-btn\" chat-value=\""+button.value+"\">"+button.name+"<\/a><\/li>";
                }).join('');
                var str="";
                str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg user\">";
                str += "          <span class=\"msg-avatar\">";
                str += "            <img src=\"https:\/\/image.crisp.im\/avatar\/operator\/196af8cc-f6ad-4ef7-afd1-c45d5231387c\/240\/?1483361727745\">";
                str += "          <\/span>";
                str += "          <div class=\"cm-msg-text\">";
                str += msg;
                str += "          <\/div>";
                str += "          <div class=\"cm-msg-button\">";
                str += "            <ul>";
                str += btn_obj;
                str += "            <\/ul>";
                str += "          <\/div>";
                str += "        <\/div>";
                $(".chat-logs").append(str);
                $("#cm-msg-"+INDEX).hide().fadeIn(300);
                $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
                $("#chat-input").attr("disabled", true);
            }

            $(document).delegate(".chat-btn", "click", function() {
                var value = $(this).attr("chat-value");
                var name = $(this).html();
                $("#chat-input").attr("disabled", false);
                generate_message(name, 'self');
            })

            $("#chat-circle").click(function() {
                $("#chat-circle").toggle('scale');
                $(".chat-box").toggle('scale');
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
            })

            $(".chat-box-toggle").click(function() {
                $("#chat-circle").toggle('scale');
                $(".chat-box").toggle('scale');
            })

            $(".chat-box-toggle-close").click(function() {
                $("#chat-circle").toggle('scale');
                $(".chat-box").toggle('scale');
                sessionStorage.removeItem('cid');
                jQuery('#cid').val('');
                jQuery('.chat-box-body').css('display','none');
                jQuery('.chat-input').css('display','none');
                jQuery('#upload_div').css('display','none');
                jQuery('#loginform').css('display','block');

            })

        })

    </script>
    <?php
}
add_action( 'wp_footer', 'chat_popup' );