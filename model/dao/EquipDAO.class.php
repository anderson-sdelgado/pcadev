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

    public function dados($base) {

        $select = " SELECT "
                    . " eq.EQUIP_ID AS \"idEquip\" "
                    . " , eq.NRO_EQUIP AS \"nroEquip\" "
                    . " , co.descr AS \"descrClasseEquip\" "
                . " from equip              eq "
                    . " , modelo_equip       me "
                    . " , fabric             fa "
                    . " , classe_oper        co "
                    . " , empr_usu           eu"
                    . " , PCA_AMBULANCIA a "
                . " where "
                  . " eq.equip_id = a.equip_id "
                  . " and me.modelequip_id    = eq.modelequip_id "
                  . " and fa.fabric_id        = me.fabric_id "
                  . " and co.classoper_id     = eq.classoper_id "
                  . " and eu.emprusu_id       = eq.emprusu_id "
                  . " and (eq.dt_desat  is null or dt_desat >= trunc(sysdate))";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

    
}
