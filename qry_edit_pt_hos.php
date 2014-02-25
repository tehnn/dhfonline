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
    $pid = $_POST[pid];

    $datetime_send = date("Y-m-d H:i:s");


    /*
    $sql = "insert into patient_hos (pid,datetime_send,office_own,user_own,hn
        ,prename,sex, name, lname, cid ,bdate ,agey,pt_tel ,family ,occupat 
        ,school_workplace ,code506 ,icd10 ,pt_type,doctor ,date_dx ,date_ill ,date_found,pt_status 
        ,symtom ,refer_from ,date_refer ,amp ,tmb ,moo ,road,addr ,lab_wbc ,note_text ,lab_plt ,lab_hct 
        ,lab_tt ,send_to_amp ,sender,img_pt )
        values
        ('$pid','$datetime_send','$_POST[office_own]','$_POST[user_own]','$_POST[hn]', '$_POST[prename]', '$_POST[sex]'
            ,'$_POST[name]', '$_POST[lname]', '$_POST[cid]', '$_POST[bdate]' ,$_POST[agey],'$_POST[pt_tel]','$_POST[family]' 
             ,'$_POST[occupat]' ,'$_POST[school_workplace]' ,'$_POST[code506]' ,'$_POST[icd10]','$_POST[pt_type]'
             ,'$_POST[doctor]' ,'$_POST[date_dx]','$_POST[date_ill]', '$_POST[date_found]' 
             ,'$_POST[pt_status]','$_POST[symtom]', '$_POST[refer_from]', '$_POST[date_refer]','$_POST[amp]', '$_POST[tmb]'
             ,'$_POST[moo]' ,'$_POST[road]','$_POST[addr]', '$_POST[lab_wbc]', '$_POST[note_text]','$_POST[lab_plt]'
             ,'$_POST[lab_hct]' , '$_POST[lab_tt]', '$_POST[send_to_amp]' ,'$_POST[sender]','$img_pt' )";
*/
    
    $sql = "update patient_hos set  hn='$_POST[hn]', prename='$_POST[prename]',sex='$_POST[sex]',name='$_POST[name]'
    ,lname='$_POST[lname]',cid='$_POST[cid]',bdate='$_POST[bdate]',agey='$_POST[agey]',pt_tel='$_POST[pt_tel]'
        ,family='$_POT[family]',occupat='$_POST[occupat]',school_workplace='$_POST[school_workplace]'
        ,code506='$_POST[code506]',icd10='$_POST[icd10]',pt_type='$_POST[pt_type]',doctor='$_POST[doctor]'
            ,date_dx='$_POST[date_dx]',date_ill='$_POST[date_ill]',date_found='$_POST[date_found]'
                ,pt_status='$_POST[pt_status]',symtom='$_POST[symtom]',refer_from='$_POST[refer_from]'
                    ,date_refer='$_POST[date_refer]',amp='$_POST[amp]',tmb='$_POST[tmb]',moo='$_POST[moo]'
                        ,road='$_POST[road]',addr='$_POST[addr]',lab_wbc= '$_POST[lab_wbc]',note_text= '$_POST[note_text]'
          ,lab_plt='$_POST[lab_plt]',lab_hct='$_POST[lab_hct]',lab_tt='$_POST[lab_tt]',sender='$_POST[sender]'
    
where pid='$pid'";

    //echo $sql;
   // mysql_query($sql) or die(mysql_error());
    //exit;
}

if (mysql_query($sql)) {
    ?>
    <script>
        alert("Edit case successful!!");
        window.location = 'pt_info.php?pid=<?= $pid ?>';
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
