<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
require_once('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of PassageiroDAO
 *
 * @author anderson
 */
class CirculacaoDAO extends Conn {
    
    public function verifCirculacao($circulacao, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PCA_CIRCULACAO "
                . " WHERE "
                . " DTHR_SAIDA_CEL = TO_DATE('" . $circulacao->dthrSaidaCirculacao . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " NRO_APARELHO = " . $circulacao->nroAparelhoCirculacao;

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insCirculacao($circulacao, $base) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();
        
        if ($circulacao->kmSaidaCirculacao > 9999999) {
            $circulacao->kmSaidaCirculacao = 0;
        }

        if ($circulacao->kmRetornoCirculacao > 9999999) {
            $circulacao->kmRetornoCirculacao = 0;
        }
        
        $sql = "INSERT INTO PCA_CIRCULACAO ("
                . " NRO_APARELHO "
                . " , DTHR_SAIDA "
                . " , DTHR_SAIDA_CEL "
                . " , DTHR_RETORNO "
                . " , DTHR_RETORNO_CEL "
                . " , MATRIC_MOTORISTA "
                . " , MATRIC_PACIENTE "
                . " , EQUIP_ID "
                . " , HOD_HOR_SAIDA "
                . " , HOD_HOR_RETORNO "
                . " , LOCAL_SAIDA_ID "
                . " , LOCAL_DESTINO_ID "
                . " , OCOR_ATEND_ID "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $circulacao->nroAparelhoCirculacao
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($circulacao->dthrSaidaCirculacao, $base)
                . " , TO_DATE('" . $circulacao->dthrSaidaCirculacao . "','DD/MM/YYYY HH24:MI')"
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($circulacao->dthrRetornoCirculacao, $base)
                . " , TO_DATE('" . $circulacao->dthrRetornoCirculacao . "','DD/MM/YYYY HH24:MI')"
                . " , " . $circulacao->matricMotoristaCirculacao
                . " , " . $circulacao->matricPacienteCirculacao
                 . " , " . $circulacao->idEquipCirculacao
                . " , " . $circulacao->kmSaidaCirculacao
                . " , " . $circulacao->kmRetornoCirculacao
                . " , " . $circulacao->idLocalSaidaCirculacao
                . " , " . $circulacao->idLocalDestinoCirculacao
                . " , " . $circulacao->idOcorAtendCirculacao
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();

    }
    
}
