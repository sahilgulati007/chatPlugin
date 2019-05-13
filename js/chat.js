jQuery( document ).ready(function() {
    if(sessionStorage.getItem("cid")){
        jQuery('#cid').val(sessionStorage.getItem("cid"));
    }
    //alert();
    jQuery('#snd').click(function () {
        //alert(jQuery('#usermsg').val());
        //alert(ajax_object.ajaxurl);
        var data = {
            'action': 'send_chat',
            'msg': jQuery('#usermsg').val(),     // We pass php values differently!
            'cid': jQuery('#cid').val()
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajax_object.ajaxurl, data, function(response) {
            //alert('Got this from the server: ' + response);
            jQuery('#usermsg').val('');
            setTimeout(function(){jQuery("#chatbox").animate({ scrollTop: $('#chatbox').prop("scrollHeight")}, 0);},3000);
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
        });
    });
    jQuery('#enter').click(function () {
        //alert(jQuery('#cname').val());
        //alert(ajax_object.ajaxurl);
        //sessionStorage.setItem("cname",jQuery('#cname').val());
        if(jQuery('#cname').val()=='' && jQuery('#em').val()==''){
            return;
        }
        var x=jQuery('#em').val();
        var atposition=x.indexOf("@");
        var dotposition=x.lastIndexOf(".");
        if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){
            return;
        }
        var data = {
            'action': 'reg_chat',
            'nm': jQuery('#cname').val(), // We pass php values differently!
            'em': jQuery('#em').val()
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajax_object.ajaxurl, data, function(response) {
            //alert('Got this from the server: ' + response);
            //jQuery('#cid').val(response);
            sessionStorage.setItem("cid",response);
            document.getElementById("myForm").style.display = "block";
            // location.reload();
        });
    });
    //console.log(jQuery("div").hasClass("chatform"));
    if(jQuery("div").hasClass("chatform")){
        setInterval(function(){
            //alert(jQuery('#cid').val());
            var id=jQuery('#cid').val();
            var data = {
                'action': 'get_chat',
                'cid': id
            };
            jQuery.post(ajax_object.ajaxurl, data, function(response) {
               // alert('Got this from the server: ' + response);
                var obj= JSON.parse(response);
                var html = '';
                obj.forEach(function (arrayItem) {
                  console.log(arrayItem);
                  var m= arrayItem.dtext;
                    if(arrayItem.texttype=='0')
                        html+= '<div style="float: left;">'+ arrayItem.dtext +'</div><br>';
                    else
                        html+= '<div style="float: right;">'+ arrayItem.dtext +'</div><br>';
                    //alert(arrayItem.notify);
                    //border: 1px solid #2e4453;border-radius: 25px; padding: 1px;
                    if(arrayItem.notifiy==1 && arrayItem.texttype == '0'){
                        jQuery('#notifiy').css('display','block');
                    }

                  //jQuery('#chatbox').append('<div>'+ arrayItem.dtext +'</div>')
                });
                jQuery('#chatbox').html(html);

            });

        }, 3000);
    }
    if(jQuery("div").hasClass("chatformadmin")){
        setInterval(function(){
            //alert(jQuery('#cid').val());
            var id=jQuery('#cid').val();
            var data = {
                'action': 'get_chat',
                'cid': id
            };
            jQuery.post(ajax_object.ajaxurl, data, function(response) {
                // alert('Got this from the server: ' + response);
                var obj= JSON.parse(response);
                var html = '';
                obj.forEach(function (arrayItem) {
                    console.log(arrayItem);
                    var m= arrayItem.dtext;
                    if(arrayItem.texttype=='0')
                        html+= '<div style="float: right">'+ arrayItem.dtext +'</div><br>';
                    else
                        html+= '<div style="float: left">'+ arrayItem.dtext +'</div><br>';

                    //jQuery('#chatbox').append('<div>'+ arrayItem.dtext +'</div>')
                });
                jQuery('#chatbox').html(html);

            });

        }, 3000);
    }
    function updatenotifiy() {
        alert();
    }
    if(jQuery("div").hasClass("chat_list")){
        setInterval(function(){
            //alert(jQuery('#cid').val());
            //var id=jQuery('#cid').val();
            var data = {
                'action': 'get_chat_list',
            };
            jQuery.post(ajax_object.ajaxurl, data, function(response) {
                // alert('Got this from the server: ' + response);
                var obj= JSON.parse(response);
                var html = '';
                obj.forEach(function (arrayItem) {
                    console.log(arrayItem);
                    var m= arrayItem.dtext;
                    if(arrayItem.texttype=='0')
                        html+= '<div style="float: right">'+ arrayItem.dtext +'</div><br>';
                    else
                        html+= '<div style="float: left">'+ arrayItem.dtext +'</div><br>';

                    //jQuery('#chatbox').append('<div>'+ arrayItem.dtext +'</div>')
                });
                jQuery('#chatbox').html(html);

            });

        }, 3000);
    }

});
// function sndfnc() {
//     alert();
//
// }