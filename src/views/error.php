
<?php
require_once dirname(__FILE__) . "/../config/conf.php";


$error = "";
if(isset($_SESSION["error"])){
    $error = $_SESSION["error"]["errorMsg"];
}
$error_code = "";
if(isset($_SESSION["error"])){
    $error_code = $_SESSION["error"]["errorCode"];
}
unset($_SESSION["error"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?= $error?></p>
    <a href="<?=ROUTE_PATH ?>category">戻る</a>
</body>
</html>