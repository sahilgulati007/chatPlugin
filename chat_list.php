<?php
function chat_list()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'chat';
    $result = $wpdb->get_results("select * from " . $table_name);
    echo "<div class='chat_list_my'>";
    foreach ($result as $r) {
        $table_name_new = $wpdb->prefix . 'chat_detail';
        $resultnew= $wpdb->get_results("select * from ".$table_name_new." where cid=".$r->cid ." and texttype='1' and notifiy='1' order by cdid");
        $rowcount = $wpdb->num_rows;
        //echo "select * from ".$table_name_new." where cid=".$r->cid ." and texttype='1' and notifiy='1' order by cdid";
        if($rowcount>0)
            echo '<div style="width: 100%;padding: 5px;"><div style="float: left;padding: 5px">'.$r->cnm.'</div><div style="float: left;padding: 5px"><a href="admin.php?page=Chat_View&id='.$r->cid.'">View Chat <span style="background: #993300;font-size: 12px;font-weight: bolder;color: white;padding: 5px;border-radius: 25px">'.$rowcount.'</span></a> </div></div><br>';
        else
            echo '<div style="width: 100%;padding: 5px;"><div style="float: left;padding: 5px">'.$r->cnm.'</div><div style="float: left;padding: 5px"><a href="admin.php?page=Chat_View&id='.$r->cid.'">View Chat</a> </div></div><br>';

    }
    echo "</div>";
}