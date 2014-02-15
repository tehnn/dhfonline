<?php
session_start();
session_destroy();
?>
<!DOCTYPE html> 
<html>
    <head>
        <?php require 'lib.php'; ?>
        <script>

            $(document).on('pageinit', '#page-index', function() {
                //alert('ssss');

                function onSuccess(data, status) {
                    //alert(data);   
                    data = $.trim(data);
                    if(data=='ok'){
                          window.location = 'main_screen.php';
                    }


                }

                function onError(data, status) {

                }

                // event click
                $("#btnOk").on('click', function() {
                    //alert('Sing in ถูก คลิก');

                    $.ajax({
                        type: "POST",
                        url: "ajx_qry_login.php",
                        cache: false,
                        data: {
                            user: $('#txtUser').val(),
                            pass: $('#txtPass').val()
                        },
                        success: onSuccess,
                        error: onError
                    });

                    return false;
                    // จบ event คลิก
                });


            });

        </script>

    </head> 
    <body> 
        <div data-role="page" id="page-index">
            <div data-role="header" data-position="fixed" data-theme="f">
                <a href="index.php" rel="external" data-icon="home">Main</a>
                <?php require 'txt_head.php'; ?>
                <a href="#page-about" data-icon="info">About</a>
            </div>
            <div data-role="content" data-theme="f">	

                <div align="center">
                    <img src="img_ic/mos.jpg" width="270" height="270"/>
                </div>

                <form id="frm_login" name="frm_login">
                    <div data-role="fieldcontain">
                        <label for="txtUser">
                            Username:
                        </label>
                        <input name="txtUser" id="txtUser" placeholder="" value="" type="text" data-clear-btn="true">
                    </div>
                    <div data-role="fieldcontain">
                        <label for="txtPass">
                            Password:
                        </label>
                        <input name="txtPass" id="txtPass" placeholder="" value="" type="text">
                    </div>
                    <div align="center">
                        <input id="btnOk" type="button" data-inline="true" data-theme="b" data-icon="check"
                               data-iconpos="left" value="Sign In">
                        <input type="reset" data-inline="true" data-theme="e" data-icon="delete"
                               data-iconpos="left" value="Cancel">

                    </div>
                </form>
                <div id="res_login" align="center"></div>


            </div>
            <div data-role="footer" data-position="fixed" data-theme="f" >
                <?php require 'txt_foot.php'; ?>
            </div>
        </div>

        <div data-role="dialog" id="page-about">
            <div data-role="header" data-theme="f">
                <h1>เกี่ยวกับ</h1>
            </div>
            <div data-role="content">
                กรุณาติดต่อขอรับ User , Password จากกลุ่มงานควบคุมโรคติดต่อ<p>
                
            </div>
        </div>



    </body>
</html>
