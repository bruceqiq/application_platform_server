# Introduction

This is an application management platform.

# Code Repository

## Client

[gitee](https://gitee.com/bruce_qiq/application_platform_client)

[github](https://github.com/bruceqiq/application_platform_client)

## Server

[gitee](https://gitee.com/bruce_qiq/application_platform_server)

[github](https://github.com/bruceqiq/application_platform_server)

# Requirements

 - PHP >= 7.4
 - Swoole PHP extension >= 4.4，and Disabled `Short Name`
 - OpenSSL PHP extension
 - JSON PHP extension
 - PDO PHP extension （If you need to use MySQL Client）
 - Redis PHP extension （If you need to use Redis Client）
 - Protobuf PHP extension （If you need to use gRPC Server of Client）
 
# Functions

- 七牛云对象存储token管理

- 使用appid和appkey进行授权模式的token管理(如微信公众号通过appid和appsecret获取到access_token才能进行操作)

- 微信模板消息发送

- 短信批量发送