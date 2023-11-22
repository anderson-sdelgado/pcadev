<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/CirculacaoDAO.class.php');
require_once('../model/dao/LogEnvioDAO.class.php');
/**
 * Description of CirculacaoCTR
 *
 * @author anderson
 */
class CirculacaoCTR {
    
    public function salvarDados($info) {

        $dados = $info['dado'];
        
        $jsonObjCirculacao = json_decode($dados);
        $dadosCirculacao = $jsonObjCirculacao->circulacao;
        $ret = $this->salvarCirculacao($dadosCirculacao);

        return $ret;
        
    }
    
    private function salvarCirculacao($dadosCirculacao) {
        $circulacaoDAO = new CirculacaoDAO();
        $idCirculacaoArray = array();
        foreach ($dadosCirculacao as $circulacao) {
            $v = $circulacaoDAO->verifCirculacao($circulacao);
            if ($v == 0) {
                $circulacaoDAO->insCirculacao($circulacao);
            }
            $idCirculacaoArray[] = array("idCirculacao" => $circulacao->idCirculacao);
        }
        $dadoCirculacao = array("passageiro"=>$idCirculacaoArray);
        $retCirculacao = json_encode($dadoCirculacao);
        
        return 'SALVOU_' . $retCirculacao;
    }
       
}
