<meta charset="UTF-8"> 
<div data-role="content" data-theme="f">	
    <pre>
        <?php
        print_r($_POST);
        ?>
    </pre>


</div>
<?php
if (!empty($_POST)) {
    require 'condb.php';
    
     echo $sql = "insert into patient_home (pid,datetime_do) values ('$_POST[pid]','$_POST[datetime_do]')";
     mysql_query($sql);
}
?>


<script>
    alert("Add case successful!!");
    window.location = 'pt_info.php?pid=<?= $_POST[pid] ?>';
</script>