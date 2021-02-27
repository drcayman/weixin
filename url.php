<?php
header('Content-type:application/json');
require_once('./class/url.class.php');
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    require_once('/Applications/phpstudy/WWW/weixin/curl.php');
} else {
    require_once('/www/wwwroot/'.$_SERVER['SERVER_NAME'].'/curl.php');
}

$urls = $_GET['url'];
$server = $_GET['server'];

$url = new Url();
$res = $url->checkUrl($urls);
if ($server) {
    $server = substr($server, -1) == '/' ? $server : $server.'/';
    if ($res['code'] == 200) {
        $wx_abn = $res['data']['wx_abn'];
        if (count($wx_abn) > 0) {
            $wx_abn = str_replace(array('http://', 'https://'), '', implode('、', $res['data']['wx_abn']));
            get_url($server.'微信域名检测'.'/'.$wx_abn.'已被微信屏蔽，请及时处理');
        }
    } elseif ($res['code'] == 202) {
        get_url($server.'微信域名检测'.'/'.$res['msg']);
    }
}

echo json_encode($res);
?>