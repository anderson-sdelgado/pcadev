<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnAPEX.class.php');
/**
 * Description of EquipDAO
 *
 * @author anderson
 */
class LocalDAO extends ConnAPEX {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " ID AS \"idLocal\" "
                        . " , DESCR AS \"descrLocal\" "
                        . " , SAIDA AS \"flagSaidaLocal\" "
                        . " , DESTINO AS \"flagDestinoLocal\" "
                    . " FROM "
                        . " LOCAL_AMBULANCIA ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    
}
