<?php
include './db.php';
header("Content-Type:text/html; charset=utf-8");
$stmt = $conn->prepare("SELECT subname,path FROM subfunction WHERE functionid='1'");
$stmt->execute();
$res = '';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $res.='<a href="' . $row['path'] . '.php" style="font-size:250%; letter-spacing: 10PX;" rel="external" class="ui-btn">' . $row['subname'] . '</a>';
}
?>
<html>
    <head data-theme="d">
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
        <style>
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
    <body >
        <div data-role="page" id="pageone">
            <div data-role="header" class="header">
                <a href="index.php" rel="external" class="ui-btn ui-btn-inline ui-corner-all ui-icon-home ui-shadow ui-btn-icon-left" style="margin-top:2%;font-size:120%;">首頁</a>
                <h1 id="title">活動分析</h1>
            </div>


            <div data-role="main" class="ui-content ui-corner-all" id="cebtn">

                <?php echo $res; ?>
            </div>


            <div data-role="footer" data-position="fixed">
                <h1></h1>
            </div>
        </div> 
    </body>
</html>


