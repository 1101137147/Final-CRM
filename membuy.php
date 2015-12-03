<?php
//include './db.php';
//header("Content-Type:text/html; charset=utf-8");
//$stmt = $conn->prepare("SELECT subname,path  FROM subfunction WHERE functionid='2'");
//$stmt->execute();
//$res='';
//foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
//    $res.='<li><a href="' . $row['path'] . '.php" style="font-size:12pt" rel="external">' . $row['subname'] . '</a></li>';
//}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">
        <script src="script/jquery-1.11.3.min.js"></script>
        <script src="script/jquery.mobile-1.4.5.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jqm-datebox.min.css" />
        <script type="text/javascript" src="script/jqm-datebox.core.min.js"></script>
        <script type="text/javascript" src="script/jqm-datebox.mode.calbox.min.js"></script>
        <script type="text/javascript" src="script/jquery.mobile.datebox.i18n.zh-TW.utf8.js"></script>
        <link rel="stylesheet" href="css/theme1.css">
        <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
        <script type="text/javascript" src="script/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#btn1").click(function() {
                    var d1 = $("#date1").val();
                    var d2 = $("#date2").val();
                    /alert( d1 +"and"+ d2);/
                    $.ajax({
                        url: "membuylist.php",
                        data: {date1: $("#date1").val(), date2: $("#date2").val()},
                        type: "GET",
                        success: function(info1) {
                            document.getElementById("info1").innerHTML = info1;
                            $('#info1').DataTable();
                            //$("#info1").html(info1);
                            //alert(info1);  
                        },
                        error: function(info1) {
                            document.getElementById("info1").innerHTML = "error";
                        }
                    });
                });
            });
        </script>
        <style>
            /*            th {
                            border-bottom: 1px solid #d6d6d6;         
                        }
            
                        tr:nth-child(even) {
                            background: #e9e9e9;
                        }*/
            #info1 tr:nth-child(even) {
                background:#d0d0d0;
            }
            .btn{
                height: 15%;  
                width:3%;
                line-height:52%;         
            }
            .header{
                height: 250%;
            }
            #title{
                font-size: 250%;
                letter-spacing: 45PX;  //文字間距
            }
        </style>
    </head>
    <body>
        <div data-role="page" id="pageone">
            <div data-role="header">
                <a href="index.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-home ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">首頁</a>
                <a href="member.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-back ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">返回</a>
                <h1 id="title">會員忠誠度</h1>
                <!--                <div data-role="navbar" >
                                    <ul>
                <?php // echo $res; ?>
                                    </ul>
                                </div>-->
            </div> 
            <div data-role="main" class="ui-content ui-grid-a">

                <label for="bday">請選擇日期範圍:</label>
                <div class="ui-block-a">
                    <input type="DATE" id="date1" >
                </div>
                <div class="ui-block-b">
                    <input type="DATE" id="date2"> 
                </div>
                <input type="button" id="btn1" value="確定">
                <table id="info1" data-role="table"  class="ui-responsive" border="1">
                </table>
            </div>

            <div data-role="footer" data-position="fixed">
                <h1></h1>
            </div>
        </div> 
    </body>
</html>


