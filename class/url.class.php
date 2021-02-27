<?php
class Url {
    public $conn;
    
    public function __construct() {
        
    }
    
    public function checkUrl($urls) {
        if ($urls) {
            $norm = [];
            $wx_abn = [];
            $dns_abn = [];
            $url_arr = explode(',', $urls);
            for ($i = 0; $i < count($url_arr); $i++) {
                preg_match('/[a-zA-z]+:\/\/[^\s]*/', $url_arr[$i], $url);
                if ($url[0]) {
                    if ($this->httpCode($url[0]) == 200) {
                        $headers = get_headers('http://mp.weixinbridge.com/mp/wapredirect?url='.$url[0]);
                        $Location = $headers[6];
                        if (preg_match('/Location: http/', $Location) == 1) {
                            if ($Location == 'Location: '.$url[0]) {
                                $norm[] = $url[0];
                            } else {
                                $wx_abn[] = $url[0];
                            }
                        } else {
                            return array(
                                'code' => 202,
                                'msg' => '查询接口错误，请及时处理'
                            );
                            exit();
                        }
                    } else {
                        $dns_abn[] = $url[0];
                    }
                } else {
                    return array(
                        'code' => 201,
                        'msg' => 'url参数错误,请传入带https或http的链接,，多个链接用英文逗号分隔'
                    );
                    exit();
                }
            }
            $res = array(
                'code' => 200,
                'data' => array(
                    'norm' => $norm,
                    'wx_abn' => $wx_abn,
                    'dns_abn' => $dns_abn
                ),
                'msg' => '检测成功'
            );
        } else {
            $res = array(
                'code' => 201,
                'msg' => '缺少url参数'
            );
        }
        return $res;
    }
    
    private function httpCode($url){
        $ch = curl_init();
        $timeout = 3;
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_exec($ch);
        return $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
}
?>