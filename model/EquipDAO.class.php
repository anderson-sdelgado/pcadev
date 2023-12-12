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
class EquipDAO extends ConnAPEX {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " EQ.EQUIP_ID AS \"idEquip\" "
                        . " , EQ.NRO_EQUIP AS \"nroEquip\" "
                        . " , CO.DESCR AS \"descrClasseEquip\" "
                    . " FROM  "
                        . " EQUIP                EQ "
                        . " , MODELO_EQUIP       ME "
                        . " , FABRIC             FA "
                        . " , CLASSE_OPER        CO "
                        . " , EMPR_USU           EU "
                        . " , PCA_AMBULANCIA    A "
                    . " where "
                        . " EQ.EQUIP_ID = A.EQUIP_ID "
                        . " AND "
                        . " ME.MODELEQUIP_ID    = EQ.MODELEQUIP_ID "
                        . " AND "
                        . " FA.FABRIC_ID        = ME.FABRIC_ID "
                        . " AND "
                        . " CO.CLASSOPER_ID     = EQ.CLASSOPER_ID "
                        . " AND "
                        . " EU.EMPRUSU_ID       = EQ.EMPRUSU_ID "
                        . " AND "
                        . " (EQ.DT_DESAT  IS NULL OR DT_DESAT >= TRUNC(SYSDATE))";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    
}
