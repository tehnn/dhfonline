<div data-role="controlgroup" data-type="horizontal" align='center'>
    <?php
    if ($level == 'hos') {
        echo "<a href='hos_list_own_pt.php' rel='external' data-icon='edit'>แจ้ง case</a>";
    }
    if (!empty($level)) {
        echo "<a href='survey_larva.php' rel='external'  data-icon='check'>สำรวจลูกน้ำ</a>";
    }
    echo "<a href='time_rpt.php' rel='external' data-icon='arrow-r'>ความทันเวลา</a>";
    echo "<a href='map_spot.php' rel='external' data-icon='star'>แผนที่</a>";
    echo "<a href='chart_prov.php' rel='external' data-icon='info'>แผนภูมิ</a>";
    if ($level == 'pro') {
        echo "<a href='#' rel='external' data-icon='edit'>จัดการผู้ใช้งาน</a>";
    }
    ?>

</div>