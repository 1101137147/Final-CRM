<?php
include './db.php';
session_start() ;
$store_id=$_SESSION['store_id'];
header("Content-Type:text/html; charset=utf-8");

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
                    var gender = $("#gender").val();
                    var buyquantity=$("#buyquantity").val();
                    var qdquantity=$("#qdquantity").val();
                    var totalpoint=$("#totalpoint").val();
                    if((d1=='')&&(d2=='')&&(gender=='')&&(buyquantity=='')&&(qdquantity=='')&&(totalpoint=='')){
                        alert("請選擇最少1項填寫");
                    }else{
                        if((d1!=='')&&(d2=='')){
                            alert("需要選擇結束日期");
                        }else if((d1=='')&&(d2!=='')){
                            alert("需要選擇開始日期");
                        }else{
                            if((d1!=='')&&(d2!=='')){
                                if(d1>d2){
                                    alert("開始日期不能大於結束日期");
                                }
                                if(d1<d2){
                                        $.ajax({
                                            url: "membuylist.php",
                                            data: {date1: $("#date1").val(), date2: $("#date2").val(), gender: $("#gender").val(), 
                                                    buyquantity: $("#buyquantity").val(), qdquantity: $("#qdquantity").val(), totalpoint: $("#totalpoint").val()},
                                            type: "GET",
                                            success: function(info1) {
                                                document.getElementById("info1").innerHTML = info1;
                                                            $('#info1').DataTable();
                                                },
                                            error: function(info1) {
                                                document.getElementById("info1").innerHTML = "error";
                                                }
                                        });
                                }
                            }else{
                                $.ajax({
                                            url: "membuylist.php",
                                            data: {date1: $("#date1").val(), date2: $("#date2").val(), gender: $("#gender").val(), 
                                                    buyquantity: $("#buyquantity").val(), qdquantity: $("#qdquantity").val(), totalpoint: $("#totalpoint").val()},
                                            type: "GET",
                                            success: function(info1) {
                                                document.getElementById("info1").innerHTML = info1;
                                                            $('#info1').DataTable();
                                                },
                                            error: function(info1) {
                                                document.getElementById("info1").innerHTML = "error";
                                                }
                                        });
                            }
                        }
                    }
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
                letter-spacing: 15PX;  /*文字間距*/
            }
        </style>
    </head>
    <body>
        <div data-role="page" id="pageone">
            <div data-role="header">
                <a href="index.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-home ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">首頁</a>
                <a href="member.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-back ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">返回</a>
                <h1 id="title">會員忠誠度</h1>
            </div> 
            <div data-role="main" class="ui-content ui-grid-a">
                <table border="0" align="center">
                    <tr>
                        <td>請選擇日期範圍：</td>
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
                        <td>選擇性別：</td>
                        <td>
                            <select name="gender" id="gender" width="300">
                                <option value=""> </option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <table border="0" align="center">
                    <tr>
                        <td>購買次數大於</td>
                        <td>
                            <input type="text" name="buyquantity" id="buyquantity"> 
                        </td>
                        <td>填寫問卷次數大於</td>
                        <td>
                            <input type="text" name="qdquantity" id="qdquantity">
                        </td>
                        <td>擁有的點數大於</td>
                        <td>
                             <input type="text" name="totalpoint" id="totalpoint">
                        </td>
                        <td>
                            <input type="button" id="btn1" value="確定">

                        </td>
            　       </tr>
                </table>

                <table id="info1" data-role="table"  class="ui-responsive" border="1">
                </table> 

            </div>

            <div data-role="footer" data-position="fixed">
                <h1></h1>
            </div>
        </div> 
    </body>
</html>


