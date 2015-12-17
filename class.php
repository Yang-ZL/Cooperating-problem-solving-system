<?php
#define
define('specialcharacter' , "$(){}<>?.,'#:\n\r\t");

class Receive {
    private $content;
    private $key;
    private $user;
    private $time;
    private $client;

    public function __construct($content, $key, $user, $together=false, $client=false) {
        $this->content = $content;
        $this->user    = $user;
        $this->client  = $client;
        if (!$together)
            $this->key = $key;
    }

    public function insert_post() {
        $this->time = time();
        $sqlhandler = new Sql();
        $sql        = "INSERT INTO `choice`(`content`, `c_key`, `c_user`, `c_time`)" .
                        "VALUES ('{$this->content}', '{$this->key}', '{$this->user}', '{$this->time}')";
        if ($sqlhandler->excute_query($sql))
            return true;
        else
            return false;
    }

    public function new_challenge() {
        $this->time = time();
        $sqlhandler = new Sql();
        // INSERT INTO together (f_user, f_content, f_time) VALUES ('user_1', 'lasdjfkla', '1111111111')
        $sql        = "INSERT INTO `together` (`f_user`, `f_content`, `f_time`) " .
                        "VALUES ('{$this->user}', '{$this->content}', '{$this->time}')";
        if ($sqlhandler->excute_query($sql))
            return true;
        else
            return false;
    }

    public function rec_challenge() {
        $sqlhandler = new Sql();
        $sql        = "SELECT * FROM `together` WHERE f_user = '{$this->user}' ORDER by f_time DESC LIMIT 0,1";
        $result     = $sqlhandler->excute_query($sql);
        $row        = $result->fetch_assoc();
        return $this->send_ms($row['f_content']);
    }
    
    public function search() {
        $response = "";
        $sqlhandler = new Sql();
        if ($this->client)
            $sql = "SELECT * FROM `choice` WHERE content LIKE '%{$this->content}%' LIMIT 0, 1 ";
        else
            $sql = "SELECT * FROM `choice` WHERE content LIKE '%{$this->content}%'";

        if ($result = $sqlhandler->excute_query($sql)) {
            if ($result->num_rows == 0)
                return $this->send_ms("暂时还没有队友碰到这题。");

            while ($row = $result->fetch_assoc()) {
                $key       = htmlspecialchars(strtoupper($row['c_key']));
                $time      = date('g:i A d / M / Y D', $row['c_time']);
                $content   = htmlspecialchars(stripcslashes($row['content']));
                $user      = htmlspecialchars(stripcslashes($row['c_user']));

                if ($this->client) 
                    $response .= $content . "|" . $key . "|" . $user;
                else
                    $response   .= "<p><strong>题目：</strong><span><pre>{$content}</pre></span></p><p><strong>答案：</strong><span class=\"answer\">{$key}</span></p><p class=\"post_info\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span> {$user} &nbsp;&nbsp;&nbsp;&nbsp; <span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> {$time}</p>";
                //$response .= "{\"content\": \"{$content}\", \"key\": \"{$key}\", \"user\": \"{$user}\", \"time\": \"{$time}\"},";
            }

            //$response = rtrim($response, ',') . "]";
            //<p><strong>题目：</strong><span><pre>{$content}</pre></span></p><p><strong>答案：</strong><span class=\"answer\">{$key}</span></p><p class=\"post_info\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span> {$user} &nbsp;&nbsp;&nbsp;&nbsp; <span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> {$time}</p>";
        }
        return $this->send_ms($response);
    }

    /*
     * 返回 POST　内容
     * $message string
     */
    public static function send_ms($message) {
        echo $message;
    }
}

// CREATE TABLE `choice` (
//  `id` int(11) NOT NULL AUTO_INCREMENT,
//  `content` text NOT NULL,
//  `c_key` varchar(20) NOT NULL,
//  `c_user` varchar(20) NOT NULL,
//  `c_time` varchar(12) NOT NULL,
//  PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8

// CREATE TABLE `together` (
//  `id` int(11) NOT NULL AUTO_INCREMENT,
//  `f_user` varchar(20) NOT NULL,
//  `f_content` text NOT NULL,
//  `f_time` varchar(20) NOT NULL,
//  PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8

class Sql {
    private $conn;
    private $host = "localhost";
    private $username = "root";
    private $password = "google";
    private $database = "cooperate";

    public function __construct() {

        $this->conn = @new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_errno) {
            printf("Connect error: NO. %d %s.\n", $this->conn->connect_errno, $this->conn->connect_error);
            exit();
        }
    }

    public function excute_query($sql) {

        $this->conn->set_charset('utf8');

        if($result = $this->conn->query($sql)) {
            return  $result;
        } else {
            printf("Query error: NO. %d %s.\n", $this->conn->errno, $this->conn->error);
            exit();
        }
        $result->free();
    }

    public function close_connect() {

        if (!empty($this->conn))
            $this->conn->close();
    }
}