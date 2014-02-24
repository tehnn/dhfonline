<div data-role="controlgroup" data-type="horizontal" align='center'>
    <?php
    echo "<a href='main_screen.php' rel='external' data-icon='home'>หน้าหลัก</a>";
    if ($login_level == 'pro') {
        echo "<a href='screen_pt_back.php' rel='external' data-icon='forward'>ผู้ป่วยส่งกลับ</a>";
    }
    if ($login_level == 'hos') {
        echo "<a href='hos_list_own_pt.php' rel='external' data-icon='edit'>แจ้ง case</a>";
    }
  
    echo "<a href='time_rpt.php' rel='external' data-icon='arrow-r'>ความทันเวลา</a>";
    echo "<a href='map_spot.php' rel='external' data-icon='star'>แผนที่</a>";
    echo "<a href='chart_prov.php' rel='external' data-icon='info'>แผนภูมิ</a>";
    if ($login_level == 'ppro') {
        echo "<a href='#' rel='external' data-icon='edit'>จัดการผู้ใช้งาน</a>";
    }
    ?>

</div>