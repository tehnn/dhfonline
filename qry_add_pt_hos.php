<meta charset="UTF-8">
<?php
/* 
 // debuging
echo "datetime_send :" . $datetime_send = date("Y-m-d H:i:s");
echo "<br>";
echo "pid:" . $pid = $_POST[office_own] . date("ymd") . $_POST[hn];
echo "<hr>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "<hr>";
echo "<pre>";
print_r($_FILES[img_pt]);
echo "<pre>";
 */ 
?>
<?php
if (!empty($_POST)) {
    require 'condb.php';
    //
    $office_own = $_POST[office_own];
    $user_own = $_POST[user_own];
    $datetime_send = date("Y-m-d H:i:s");
    $hn = $_POST[hn];
    $pid = trim($_POST[office_own] . date("ymd") . $_POST[hn]);
    $prename = $_POST[prename];
    $name = $_POST[name];
    $lname = $_POST[lname];
    $cid = $_POST[cid];
    $sex = $_POST[sex];
    $bdate = $_POST[bdate];
    $occupat = $_POST[occupat];
    $school_workplace = $_POST[school_workplace];
    $tel=$_POST[tel];
    $date_ill = $_POST[date_ill];
    $date_found = $_POST[date_found];
    $addr_ill = $_POST[addr_ill];
    $addr_home = $_POST[addr_home];
    $code506 = $_POST[code506];
    $icd10 = $_POST[icd10];
    $note_text = trim(($_POST[note_text]));
    if (!empty($_FILES[img_pt][name])) {
        $img_pt = $pid . $_FILES[img_pt][name];
    }
    $sender = $_POST[sender];
    $send_to_amp = $_POST[send_to_amp];
    //
    echo $sql = "insert into patient_hos 
        (office_own,user_own,datetime_send,hn,pid,prename,name,lname,cid,
        sex,bdate,occupat,school_workplace,tel,date_ill,date_found,addr_ill,addr_home,
        code506,icd10,note_text,img_pt,sender,send_to_amp) 
        values 
        ('$office_own','$user_own','$datetime_send','$hn','$pid','$prename','$name','$lname','$cid',
        '$sex','$bdate','$occupat','$school_workplace','$tel','$date_ill','$date_found','$addr_ill','$addr_home',
        '$code506','$icd10','$note_text','$img_pt','$sender','$send_to_amp')";
}

if (mysql_query($sql)) {
    ?>
    <script>
        alert("Add case successful!!");
        window.location = 'hos_list_own_pt.php';
    </script>
    <?php
} else {
    ?>
    <script>
        alert("<?= mysql_error() ?>");
        window.history.back();
    </script>
    <?php
}
?>
