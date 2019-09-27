<?php

namespace util;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * rabbitMQ 消息队列    公共类库
 * Created by Malcolm
 * Date: 2017/8/18 16:46
 */
class RabbitMQ
{
    /**
     * @var AMQPStreamConnection
     */
    protected $connection;
    protected $queue_key;
    protected $exchange_key;
    protected $exchange_suffix;
    protected $priority;
    protected $channel;

    public function __construct($queue_name, $priority = null)
    {
        $this->host = MQ_IP;
        $this->port = MQ_PORT;
        $this->username = MQ_USER;
        $this->password = MQ_PWD;
        $this->vhost = MQ_HOST;
        $this->exchange = 'erp_exchange';
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->username, $this->password, $this->vhost);
        $this->queue_key = 'erp_' . $queue_name;
        $this->exchange_suffix = $this->exchange;
        $this->priority = $priority;
        $this->channel = $this->connection->channel();

        // 绑定交换机
        $this->bindExchange();
        return $this->connection;
    }

    /**
     * 绑定交换机
     * @return mixed|null
     */
    protected function bindExchange()
    {
        $queue_key = $this->queue_key;
        $exchange_key = $this->exchange_suffix;
        $this->exchange_key = $exchange_key;
        $channel = $this->channel;


        if (!empty($this->priority)) {
            $priorityArr = array('x-max-priority' => array('I', $this->priority));
            $size = $channel->queue_declare($queue_key, false, true, false, false, false, $priorityArr);
        } else {
            $size = $channel->queue_declare($queue_key, false, true, false, false);
        }
        $channel->exchange_declare($exchange_key, 'topic', false, true, false);
        $channel->queue_bind($queue_key, $exchange_key, $queue_key);
        $this->channel = $channel;
        return $size;
    }

    /**
     * 发送数据到队列
     * @param $data = array('key'=>'val')
     */
    public function put($data)
    {
        $channel = $this->channel;
        $value = json_encode($data);
        $toSend = new AMQPMessage($value, array('content_type' => 'application/json', 'delivery_mode' => 2));
        $channel->basic_publish($toSend, $this->exchange_key, $this->queue_key);
    }

    /**
     * 获取数据
     * @return mixed
     */
    public function get()
    {
        $channel = $this->channel;
        $message = $channel->basic_get($this->queue_key);
        if (!$message) {
            return array(null, null);
        }
        $ack = function () use ($channel, $message) {
            $channel->basic_ack($message->delivery_info['delivery_tag']);
        };
        $result = $message->body;
        return array($ack, $result);
    }

    /**
     * 关闭链接
     */
    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * 获得队列长度
     * @return int
     */
    public function length()
    {
        $info = $this->bindExchange();
        return $info[1];
    }
}
