<?php
function chat_view(){
    if(isset($_POST['submitmsg'])){
        global $wpdb; // this is how you get access to the database

        $msg = $_POST['usermsg'] ;
        $cid = $_POST['cid'] ;
        $table_name = $wpdb->prefix . 'chat_detail';
        $d=$wpdb->insert(
            $table_name,
            array(
                'cid' => $cid,
                'dtext' => $msg,
                'texttype' => '0',
                'notifiy' => 1
            )
        );
        //echo $d;
    }

    global $wpdb; // this is how you get access to the database
    $cid = $_GET['id'] ;
    $table_name = $wpdb->prefix . 'chat';
    $resultchat= $wpdb->get_results("select * from ".$table_name." where cid=".$cid);
    //var_dump($resultchat);
    foreach ($resultchat as $r){
        echo '<div>Name: '.$r->cnm.' &nbsp; &nbsp; &nbsp; Email: '.$r->cemail.'</div>';
    }
    $table_name = $wpdb->prefix . 'chat_detail';
    $result= $wpdb->get_results("select * from ".$table_name." where cid=".$cid);
    echo "<div id='chatbox' class='chatformadmin' style='width: 35%'>";
    foreach ($result as $r){

        if($r->texttype=='0')
            echo "<div style='float: right'>".$r->dtext."</div><br>";
        else
            echo "<div style='float: left'>".$r->dtext."</div><br>";
    }
    echo "</div>";
    $wpdb->update(
        $table_name,
        array(
            'notifiy' => '0',
        ),
        array(
            'cid' => $cid,
            'texttype' => '1'
        ));
    ?>
    <form name="message" action="" method="post">
        <input type="hidden" name="cid" id="cid" value="<?php echo $cid; ?>">
        <input name="usermsg" type="text" id="usermsg" size="63"/>
        <input name="submitmsg" type="submit" id="submitmsg" value="Send"/>
    </form>


<?php


}
