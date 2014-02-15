<meta charset="UTF-8">
<?php

echo $date_add=date("Y-m-d");
echo "<br>";
echo $time_add=date("H:i:s");
echo "<br>";
echo $pid=$_POST[office_own].date("ymd").$_POST[hn];
echo "<hr>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "<hr>";
echo "<pre>";
print_r($_FILES[img_pt]);
echo "<pre>";
?>

<?php
if (!empty($_POST[name])) {
    ?>
    <script>
       // window, location = 'hos_list_own_pt.php';
    </script>
    <?php
}
?>
