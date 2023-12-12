<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/ConnAPEX.class.php');
/**
 * Description of PassageiroDAO
 *
 * @author anderson
 */
class ViagemDAO extends ConnAPEX {
    
    public function verifViagem($viagem) {

        $select = " SELECT "
                        . " COUNT(*) AS QTDE "
                    . " FROM "
                        . " PCA_CIRCULACAO "
                    . " WHERE "
                        . " DTHR_APONT = TO_DATE('" . $viagem->dthrViagem . "','DD/MM/YYYY HH24:MI')"
                        . " AND "
                        . " ID_CEL = " . $viagem->idViagem
                        . " AND "
                        . " NRO_APARELHO = " . $viagem->nroAparelhoViagem;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insViagem($viagem) {
        
        if (!isset($viagem->dthrSaidaViagem) || empty($viagem->dthrSaidaViagem)) {
            $viagem->dthrSaidaViagem = "null";
        } else {
            $viagem->dthrSaidaViagem = " TO_DATE('" . $viagem->dthrSaidaViagem . "','DD/MM/YYYY HH24:MI') ";
        }
        
        if (!isset($viagem->dthrChegadaViagem) || empty($viagem->dthrChegadaViagem)) {
            $viagem->dthrChegadaViagem = "null";
        } else {
            $viagem->dthrChegadaViagem = " TO_DATE('" . $viagem->dthrChegadaViagem . "','DD/MM/YYYY HH24:MI') ";
        }
        
        if (!isset($viagem->matricPacienteViagem) || empty($viagem->matricPacienteViagem)) {
            $viagem->matricPacienteViagem = "null";
        }
        
        if (!isset($viagem->kmSaidaViagem) || empty($viagem->kmSaidaViagem)) {
            $viagem->kmSaidaViagem = "null";
        } elseif ($viagem->kmSaidaViagem > 9999999) {
            $viagem->kmSaidaViagem = 0;
        }
        
        if (!isset($viagem->kmChegadaViagem) || empty($viagem->kmChegadaViagem)) {
            $viagem->kmChegadaViagem = "null";
        } elseif ($viagem->kmChegadaViagem > 9999999) {
            $viagem->kmChegadaViagem = 0;
        }

        if (!isset($viagem->idLocalSaidaViagem) || empty($viagem->idLocalSaidaViagem) || ($viagem->idLocalSaidaViagem == 0)) {
            $viagem->idLocalSaidaViagem = "null";
        }
        
        if (!isset($viagem->idLocalDestinoViagem) || empty($viagem->idLocalDestinoViagem)) {
            $viagem->idLocalDestinoViagem = "null";
        } 
        
        if (!isset($viagem->idOcorAtendViagem) || empty($viagem->idOcorAtendViagem)) {
            $viagem->idOcorAtendViagem = "null";
        }
        
        $sql = "INSERT INTO PCA_CIRCULACAO ("
                            . " NRO_APARELHO "
                            . " , DTHR_SAIDA "
                            . " , DTHR_RETORNO "
                            . " , MATRIC_MOTORISTA "
                            . " , MATRIC_PACIENTE "
                            . " , EQUIP_ID "
                            . " , HOD_HOR_SAIDA "
                            . " , HOD_HOR_RETORNO "
                            . " , LOCAL_SAIDA_ID "
                            . " , LOCAL_DESTINO_ID "
                            . " , OCOR_ATEND_ID "
                            . " , DTHR_TRANS "
                            . " , DTHR_APONT "
                            . " , ID_CEL "
                        . " ) "
                        . " VALUES ("
                            . " " . $viagem->nroAparelhoViagem
                            . " , " . $viagem->dthrSaidaViagem
                            . " , " . $viagem->dthrChegadaViagem
                            . " , " . $viagem->matricMotoristaViagem
                            . " , " . $viagem->matricPacienteViagem
                             . " , " . $viagem->idEquipViagem
                            . " , " . $viagem->kmSaidaViagem
                            . " , " . $viagem->kmChegadaViagem
                            . " , " . $viagem->idLocalSaidaViagem
                            . " , " . $viagem->idLocalDestinoViagem
                            . " , " . $viagem->idOcorAtendViagem
                            . " , SYSDATE "
                            . " , TO_DATE('" . $viagem->dthrViagem . "','DD/MM/YYYY HH24:MI')"
                            . " , " . $viagem->idViagem
                        . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();

    }
    
}
