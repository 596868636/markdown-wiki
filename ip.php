<?php
$bIp = $_SERVER["REMOTE_ADDR"]; //获取本机的局域网IP
exec('/sbin/arp '.$bIp,$aIp); //获取局域网中的其他IP
if($_POST['ip']){
    $open=fopen("Product.wiki/50000|运维网络/51000|内部网络/ip.md","a" );
    $str = $_POST['ip']."|".$_POST['zj']."|".$_POST['mac']."|".$_POST['bm']."|".$_POST['name']."|".$_POST['wz']."\r\n";
    fwrite($open,$str);
    fclose($open);
    echo "<script>alert('".$_POST['name']."的信息提交成功!')</script>";
}
?>
<html>
<head>
    <title>
        网络信息收集
    </title>
</head>
<body>
<form action="" method="post">
    <table style="margin: auto;padding:auto;">
        <tr>
            <td colspan="2"><h1 style="margin: auto;padding:auto;">Ric网络信息采集</h1><br></td>
        </tr>
        <tr>
            <td>IP:</td>
            <td><input name="ip" value="<?php echo $bIp; ?>"></td>
        </tr>
        <tr>
            <td>主机名:</td>
            <td><input name="zj" value="<?php echo gethostbyaddr($bIp); ?>"></td>
        </tr>
        <tr>
            <td>MAC地址:</td>
            <td><input name="mac" value="<?php echo substr($aIp[1],stripos($aIp[0],'HWaddress'),17); ?>"></td>
        </tr>
        <tr>
            <td>部门:</td>
            <td><input name="bm" value=""></td>
        </tr>
        <tr>
            <td>姓名:</td>
            <td><input name="name" value=""></td>
        </tr>
        <tr>
            <td>位置:</td>
            <td><input name="wz" value=""></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">提交</button></td>
    </table>
</form>
</body>
</html>
