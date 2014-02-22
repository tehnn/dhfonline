<meta charset="UTF-8">
<?php
// debuging
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "<hr>";
echo "<pre>";
print_r($_FILES[img_act]);
echo "<pre>";

*/
//exit;
?>
<?php
if (!empty($_POST)) {
    require 'condb.php';
   

    if (!empty($_FILES[img_act][name])) {
        $img_act = $pid . $_FILES[img_home][name];
    }

    //
    $sql="insert into patient_home (id,pid , datetime_do , lat , lng , occupat , school_workplace , 
            date_ill_diff , travel_to , date_travel , s1 , f1 , ci1 , s2 , f2 , ci2 , s3 , f3 , 
            ci3 , s4 , f4 , hi , s5 , f5 , ci , bi , chk_spray ,  num_spray_home , 
            chk_destroy ,  num_destroy_home , chk_meeting ,chk_campaign , chk_other , 
            note_other , note_env , note_sum , reporter , img_act) values ( 
            null,'$_POST[pid]' , '$_POST[datetime_do]' , '$_POST[lat]' , '$_POST[lng]' , '$_POST[occupat]' , 
            '$_POST[school_workplace]' , '$_POST[date_ill_diff]' , '$_POST[travel_to]' , '$_POST[date_travel]' , 
            '$_POST[s1]' , '$_POST[f1]' , '$_POST[ci1]' , '$_POST[s2]' , '$_POST[f2]' , '$_POST[ci2]' , '$_POST[s3]' , 
            '$_POST[f3]' , '$_POST[ci3]' , '$_POST[s4]' , '$_POST[f4]' , '$_POST[hi]' , '$_POST[s5]' , '$_POST[f5]' ,
            '$_POST[ci]' , '$_POST[bi]' , '$_POST[chk_spray]' , '$_POST[num_spray_home]' , '$_POST[chk_destroy]' , 
            '$_POST[num_destroy_home]' , '$_POST[chk_meeting]' , '$_POST[chk_campaign]' , '$_POST[chk_other]' , 
            '$_POST[note_other]' , '$_POST[note_env]' , '$_POST[note_sum]' , '$_POST[reporter]' , '$img_act')";
    
    //echo $sql ;
    //mysql_query($sql) or die(mysql_error());
    //exit;
}

if (mysql_query($sql)) {
    ?>
    <script>
        alert("Add activity successful!!");
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
