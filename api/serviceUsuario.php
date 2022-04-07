<?php
	header("Access-Control-Allow-Origin: *");

    $var = $_GET['var'];

    if($var == 3) {
        $ip = $_SERVER['REMOTE_ADDR'];
        echo "IP address is - ".$ip;

        $db = new mysqli('localhost', 'root', '', 'api_ssrf');

        $query = "INSERT INTO white_list (ip) VALUES ('$ip')";
        
        $db->query($query);

        $result = $db->query('select * from white_list');
        $return_arr = array();

        if($result) {
        while ($row = $result->fetch_assoc()){
                $row_array['id'] = $row['id']; 
                $row_array['ip'] = $row['ip']; 
                array_push($return_arr,$row_array);
            }

            $result->free();
        }

        echo json_encode($return_arr);

        $db->close();
    }

    $ip_acesso = $_SERVER['REMOTE_ADDR'];

    $ip_permitido = "";

    $db = new mysqli('localhost', 'root', '', 'api_ssrf');
        
    $result = $db->query('select * from white_list');

    if($result) {
        while ($row = $result->fetch_assoc()){
            $ip_permitido = $row['ip']; 
        }

        $result->free();
    }
    
    $db->close();

    if($ip_acesso != $ip_permitido) {
        echo "negado";
    }
    else{
        if($var == 1) {
            $db = new mysqli('localhost', 'root', '', 'api_ssrf');

            $nome = $_GET['nome'];
            $login = $_GET['login'];
            $senha = $_GET['senha'];

            $query = "INSERT INTO cliente (nome, login, senha) VALUES ('$nome', '$login', '$senha')";
            
            $db->query($query);
            $db->close();
        }
        
        if($var == 2) {
            $db = new mysqli('localhost', 'root', '', 'api_ssrf');
            
            $result = $db->query('select * from cliente');
            $return_arr = array();

            if($result) {
            while ($row = $result->fetch_assoc()){
                    $row_array['id'] = $row['id']; 
                    $row_array['nome'] = $row['nome']; 
                    $row_array['login'] = $row['login'];
                    $row_array['senha'] = $row['senha'];
                    array_push($return_arr,$row_array);
                }

                $result->free();
            }

            echo json_encode($return_arr);
            
            $db->close();
        }

        else {
            echo "./";
        }
    }
?>