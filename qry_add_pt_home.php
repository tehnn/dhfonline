<meta charset="UTF-8">
<?php

  // debuging
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  echo "<hr>";
  echo "<pre>";
  print_r($_FILES[img_home]);
  echo "<pre>";
  echo "<pre>";
  print_r($_FILES[img_activity]);
  echo "<pre>";

  exit;
?>
<?php
if (!empty($_POST)) {
    require 'condb.php';
    //
    $pid=$_POST[pid];
    $office_own=$_POST[office_own];
    $user_do = $_POST[user_do];
    $office_do = $_POST[office_do];
    $datetime_do = $_POST[datetime_do];
    $amp=$_POST[amp];
    $tmb=$_POST[tmb];
    $moo=$_POST[moo];
    $road=$_POST[road];
    $addr=$_POST[addr];
    $house_id=$_POST[house_id];
    $lat = $_POST[lat];
    $lng=$_POST[lng];
    $is_larva=$_POST[is_larva];
    $note_patient=$_POST[note_patient];
    $note_home=$_POST[note_home];
    $note_activity=$_POST[note_activity];
           
    
    
    //
   
    if (!empty($_FILES[img_home][name])) {
        $img_pt = $pid . $_FILES[img_home][name];
    }
     if (!empty($_FILES[img_activity][name])) {
        $img_pt = $pid . $_FILES[img_activity][name];
    }
    $reporter = $_POST[reporter];
    
    //
    echo $sql = "";
}

if (mysql_query($sql)) {
    ?>
    <script>
        alert("Add activity successful!!");
        window.location = 'pt_info.php?pid=...';
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
