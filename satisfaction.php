<?php
include './db.php';
session_start();
$store_id = $_SESSION['store_id'];
header("Content-Type:text/html; charset=utf-8");
//$stmt = $conn->prepare("SELECT subname,path FROM subfunction WHERE functionid='1'");
//$stmt->execute();
//$res='';
//foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
//    $res.='<li><a href="' . $row['path'] . '.php" style="font-size:12pt" rel="external">' . $row['subname'] . '</a></li>';
//}
$stmt2 = $conn->prepare("SELECT qst_name  FROM questionnaire  where qst_type='act' and questionnaire.store_id='" . $store_id . "'");
$stmt2->execute();
$res2 = '';
foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $res2.='<option value="' . $row['qst_name'] . '">' . $row['qst_name'] . '</option>';
}
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
        <script type="text/javascript"  src="script/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#chose").click(function() {
                    var d1 = $("#date1").val();
                    var d2 = $("#date2").val();
                    var active = $("#active").val();
                    //   document.getElementById("actname").innerHTML = active;
                    //    /alert( d1 +"and"+ d2);/
                    if ((d1 !== '') && (d2 !== '')) {
                        if (d1 > d2) {
                            alert("開始日期不能大於結束日期");
                        }
                        if (d1 < d2) {
                            $.ajax({
                                url: "satisfactionList.php",
                                data: {date1: $("#date1").val(), date2: $("#date2").val(), active: $("#active").val()},
                                type: "GET",
                                success: function(qusum) {
                                    console.log(qusum);
                                    document.getElementById("qusum").innerHTML = qusum;
                                    $('#info1').DataTable();
                                    //$("#info1").html(info1); 
                                },
                                error: function(qusum) {
                                    document.getElementById("qusum").innerHTML = "error";
                                }
                            });
                        }
                    } else
                        (
                                alert("請選擇日期")
                                )
                });
            });

        </script>
        <style>
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
                letter-spacing: 15PX;  //文字間距
            }

        </style>

    </head>
    <body>
        <div data-role="page" id="pageone">
            <div data-role="header">
                <a href="index.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-home ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">首頁</a>
                <a href="active.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-back ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">返回</a>
                <h1 id="title">活動滿意度</h1>
                <!--                <div data-role="navbar" >
                                    <ul>
<?php // echo $res;  ?>
                                    </ul>
                                </div>-->
            </div>

            <div data-role="main" class="ui-content">
                <table border="0" align="center">
                    <tr>
                        <td>活動區間</td>
                        <td> 
                            <div class="ui-block-a">
                                <input type="DATE" id="date1" >
                            </div>

                        </td>
                        <td><div>～</div></td>
                        <td>
                            <div class="ui-block-a">
                                <input type="DATE" id="date2" >
                            </div>
                        </td>
                        <td>選擇問卷名稱：</td>
                        <td>
                            <select name="active" id="active" width="300">
<?php echo $res2; ?>
                            </select>
                        </td>
                        <td>
                            <input type="button" id="chose" value="確定">

                        </td>
            　</tr>
                </table>
              <!--  <table align="center">
                   
                    <tr id="actname">  </tr><br>  
                    <tr id="info1" class="ui-responsive" border="1">      </tr>
                </table> -->
<!--                <table id="info1" data-role="table"  class="ui-responsive" border="1">
                </table>-->

                <div id="qusum">

                </div>
            </div>

            <div data-role="footer" data-position="fixed">
                <h1></h1>
            </div>
        </div> 
    </body>
</html>


