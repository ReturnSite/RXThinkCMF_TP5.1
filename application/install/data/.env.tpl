//调试模式
app_debug = true
//应用Trace
app_trace = true

// 数据库配置
[database]
type = #[type]
hostname = #[hostname]
database = #[database]
username = #[username]
password = #[password]
hostport = #[hostport]
charset = utf8mb4
prefix = #[prefix]
debug = true

// 缓存配置
[cache]
type = redis
host = 127.0.0.1
port = 6379
password =
prefix = RX_

// 消息队列
[rabbitmq]
host = /
ip = 127.0.0.1
port = 5672
user = guest
password = guest

// 全局配置
[system]
site_name = #[site_name]
nick_name = #[nick_name]
version = v3.0.0
attach_path = #[attach_path]\public\uploads

// 网址配置
[domain]
site_url =
main_url = #[main_url]
wap_url =
api_url =
script_url =
image_url =

