<?php
    define('SESSIONID',"webUser");
    define('URL','http://mattprofe.com.ar:81/alumno/3890/ACTIVIDADES/CLASE_11');

    function dbConnect(){
        $db = new mysqli('localhost', 'adm_webgenerator', 'webgenerator2020', 'webgenerator');
        return $db;
    }

    function insertWeb($idUser,$web){
        $sql = "INSERT INTO `webs` (`idUsuario`, `dominio`) VALUES (?,?);";
        $db = dbConnect();
        $query = $db->prepare($sql);
        $query->bind_param('is',$idUser,$web);
        if($query->execute()){
            return $query->insert_id;
        }
        return false;
    }

    function isWeb($web){
        $sql ="SELECT `idWeb` FROM `webs` WHERE dominio='$web';";
        $db = dbConnect();
        $query = $db->query($sql);
        if($query->num_rows >= 1){
            return true;
        }
        return false;
    }

    function getWebs($idUser){
        if(!is_numeric($idUser)){
            return -1;
        }
        $sql ="SELECT `idWeb`,dominio FROM `webs` WHERE idUsuario=$idUser;";
        $db = dbConnect();
        $query = $db->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    function getAllWebs(){
        $sql ="SELECT `idWeb`,dominio FROM `webs`";
        $db = dbConnect();
        $query = $db->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC);       
    }

    function getWebById($id){
        if(!is_numeric($id)){
            return -1;
        }
        $sql ="SELECT * FROM `webs` WHERE idWeb=$id;";
        $db = dbConnect();
        $query = $db->query($sql);
        return $query->fetch_all(MYSQLI_ASSOC)[0];       
    }

    function deleteWeb($id,$user){
        if(!is_numeric($id)){
            return -1;
        }
        $sql ="DELETE FROM `webs` WHERE `idWeb`=$id and idUsuario=$user;";
        $db = dbConnect();
        $query = $db->query($sql);
        if($db->affected_rows >= 1){
            return true;
        }
        return false;
    }



?>