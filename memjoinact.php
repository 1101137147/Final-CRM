<?php
//include './db.php';
//header("Content-Type:text/html; charset=utf-8");
//$stmt = $conn->prepare("SELECT subname,path  FROM subfunction WHERE functionid='2'");
//$stmt->execute();
//$res='';
//foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
//    $res.='<li><a href="'.$row['path'].'.php" style="font-size:12pt" rel="external">'.$row['subname'].'</a></li>';
//}
//$stmt2 = $conn->prepare("SELECT act_name  FROM activity");
//$stmt2->execute();
//$res2='';
//foreach($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row){
//    $res2.='<option value="'.$row['act_name'].'">'.$row['act_name'].'</option>';
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
                    var num1 = $("#date1").val();
                    var num2 = $("#date2").val();
                    // var active = $("#active").val();
                    /alert( d1 +"and"+ d2);/
                    if ((num1 !== '') && (num2 !== '')) {
                          if(num1>num2){
                            alert("開始日期不能大於結束日期");
                        }
                        if(num1<num2){
                        $.ajax({
                            url: "memjoinactlist.php",
                            data: {text1: $("#date1").val(), text2: $("#date2").val()},
                            type: "GET",
                            success: function(actsum) {
                                document.getElementById("actsum").innerHTML = actsum;
                                $('#info1').DataTable();
                                //$("#info1").html(info1); 
                            },
                            error: function(actsum) {
                                document.getElementById("actsum").innerHTML = "error";

                            }
                        });
                    }
                    } else {
                        alert("請選擇日期")
                    }
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
                letter-spacing: 15PX;  //文字間距
            }
        </style>
    </head>
    <body>
        <div data-role="page" id="pageone">
            <div data-role="header">
                <a href="index.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-home ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">首頁</a>
                <a href="member.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-back ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">返回</a>
                <h1 id="title">會員活動參與率</h1>
                <!--                <div data-role="navbar" >
                                    <ul>
                <?php // echo  $res; ?>
                                    </ul>
                                </div>-->
            </div>
            <div data-role="main" class="ui-content">     
                <table border="0" align="center">
                    <tr>
                        <td>請選擇活動日期：</td>
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
                        <td>
                            <input type="button" id="btn1" value="確定">

                        </td>
            　</tr>
                </table>
                <div id="actsum">
                    
                </div>
            </div>
        </div>
        <div data-role="footer" data-position="fixed">
            <h1></h1>
        </div>
    </div> 
</body>
</html>


