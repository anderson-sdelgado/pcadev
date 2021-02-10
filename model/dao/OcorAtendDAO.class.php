<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnAPEX.class.php');
/**
 * Description of FuncDAO
 *
 * @author anderson
 */
class OcorAtendDAO extends ConnAPEX {
    //put your code here
    
    public function dados($base) {

        $select = " SELECT "
                    . " ID AS \"idOcorAtend\" "
                    . " , DESCR AS \"descrOcorAtend\" "
                . " FROM "
                    . " OCOR_ATENDIMENTO ";
        
        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
