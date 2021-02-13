# 微信接口
## 微信域名拦截批量检测
访问接口并传入需要检测的域名（多个域名用英文逗号隔开）即可批量检测。挂上每日访问一次接口的定时任务即可每日自动批量检测，配合Bark可实现检测到域名被微信拦截自动推送到收集。
### 所需文件
* class/url.class.php
* url.php
* curl.php
### 使用方法
将所需文件上传到服务器即可
### 接口
[域名]/url.php?url=[需要检测的域名]
* 传参
  * [必传]url：需要检测的域名，多个域名用英文逗号隔开
  * [非必传]server：Bark服务器地址
    * 传入server后，当作者数据发生变化会通过Bark推送到iPhone，否则不推送
* 例如：onAug11.cn/url.php?url=https://www.taobao.com,https://www.douyin.com
***
## Bark
Bark是iPhone上的一款APP，提供http接口，简单调用即可给自己的iPhone发送推送。
点击[这里](https://apps.apple.com/cn/app/bark-%E7%BB%99%E4%BD%A0%E7%9A%84%E6%89%8B%E6%9C%BA%E5%8F%91%E6%8E%A8%E9%80%81/id1403753865)安装Bark
***
## 注
本接口仅用于PHP学习，请勿用于其他用途