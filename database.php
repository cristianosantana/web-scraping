<?php

function backupLog($data){
    $file = 'log.txt';
    $content = json_encode($data) . PHP_EOL;
    file_put_contents($file, $content, FILE_APPEND);
}

function insert($data){
    $servername = "remotemysql.com";
    $dbname = "7vCzPHzvTV";
    $username = "7vCzPHzvTV";
    $password = "2r5PeNV449";
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $info = $data['info'];
    $id = intval($info['id']);
    $data = [
          ':extenal_id' => $id,
          ':url'        => substr($data['url'], 0, 250),
          ':title'      => substr($data['title'], 0, 300),
          ':content'    => $data['content'],
          ':created_at' => date('Y-m-d', strtotime($info['created_at'])),
          ':company'    => substr($info['company'], 0, 100),
          ':district'   => substr($info['district'], 0, 60),
          ':locality'   => substr($info['locality'], 0, 60),
          ':salary'     => substr($info['salary'], 0, 40),
        ];
        
        
    $sql = "SELECT * FROM jobs WHERE extenal_id = $id"; 
    $result = $pdo->query($sql); 
        
    echo "$id - ";

    if(!$result->fetch()) {
        $stmt = $pdo->prepare('INSERT INTO jobs (extenal_id, url, title, content, created_at, company, district, locality, salary) VALUES(:extenal_id, :url, :title, :content, :created_at, :company, :district, :locality, :salary)');
        try {
            $stmt->execute($data) ? $data["status"] = "Success" : $data["status"] = "Error " . $stmt->rowCount();
            backupLog($data);
            echo " Criado."; 
        } catch(\Except $e) {
            $data["status"] = "error: " . json_encode($e); 
            backupLog($data);
        }
    } else {
        echo "já cadastrado!";
    }
}