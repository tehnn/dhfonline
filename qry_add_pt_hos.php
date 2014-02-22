<meta charset="UTF-8">
<?php
//debuging
/*
  echo "pid:" . $pid = $_POST[office_own] . date("ymd") . $_POST[hn];
  echo "<br>";
  echo "datetime_send :" . $datetime_send = date("Y-m-d H:i:s");
  echo "<hr>";
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  echo "<hr>";
  echo "<pre>";
  print_r($_FILES[img_pt]);
  echo "<pre>";

 */
//exit;
?>
<?php
if (!empty($_POST)) {
    require 'condb.php';
    //
    $pid = trim($_POST[office_own] . date("ymd") . $_POST[hn]);
    $datetime_send = date("Y-m-d H:i:s");



    if (!empty($_FILES[img_pt][name])) {
        $img_pt = $pid . $_FILES[img_pt][name];
    }

    //
    $sql = "insert into patient_hos (pid,datetime_send,office_own,user_own,hn
        ,prename,sex, name, lname, cid ,bdate ,pt_tel ,family ,occupat 
        ,school_workplace ,code506 ,icd10 ,pt_type,doctor ,date_dx ,date_ill ,date_found,pt_status 
        ,symtom ,refer_from ,date_refer ,amp ,tmb ,moo ,addr ,lab_wbc ,note_text ,lab_plt ,lab_hct 
        ,lab_tt ,send_to_amp ,sender,img_pt )
        values
        ('$pid','$datetime_send','$_POST[office_own]','$_POST[user_own]','$_POST[hn]', '$_POST[prename]', '$_POST[sex]'
            ,'$_POST[name]', '$_POST[lname]', '$_POST[cid]', '$_POST[bdate]' ,'$_POST[pt_tel]','$_POST[family]' 
             ,'$_POST[occupat]' ,'$_POST[school_workplace]' ,'$_POST[code506]' ,'$_POST[icd10]','$_POST[pt_type]'
             ,'$_POST[doctor]' ,'$_POST[date_dx]','$_POST[date_ill]', '$_POST[date_found]' 
             ,'$_POST[pt_status]','$_POST[symtom]', '$_POST[refer_from]', '$_POST[date_refer]','$_POST[amp]', '$_POST[tmb]'
             ,'$_POST[moo]' ,'$_POST[addr]', '$_POST[lab_wbc]', '$_POST[note_text]','$_POST[lab_plt]'
             ,'$_POST[lab_hct]' , '$_POST[lab_tt]', '$_POST[send_to_amp]' ,'$_POST[sender]','$img_pt' )";
   
    //echo $sql;
    //mysql_query($sql) or die(mysql_error());
    //exit;
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
