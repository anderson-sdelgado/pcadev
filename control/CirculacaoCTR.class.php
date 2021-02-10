<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/CirculacaoDAO.class.php');
require_once('../model/dao/LogDAO.class.php');
/**
 * Description of CirculacaoCTR
 *
 * @author anderson
 */
class CirculacaoCTR {
    
    private $base = 1;
    
    public function salvarDados($versao, $info, $pagina) {

        $dados = $info['dado'];
        $pagina = $pagina . '-' . $versao;
        $this->salvarLog($dados, $pagina);

        $versao = str_replace("_", ".", $versao);
        
        if ($versao >= 1.00) {
            
            $jsonObjCirculacao = json_decode($dados);
            $dadosCirculacao = $jsonObjCirculacao->circulacao;
            $ret = $this->salvarCirculacao($dadosCirculacao);

            return $ret;
        }
    }
    
    private function salvarCirculacao($dadosCirculacao) {
        $circulacaoDAO = new CirculacaoDAO();
        $idCirculacaoArray = array();
        foreach ($dadosCirculacao as $circulacao) {
            $v = $circulacaoDAO->verifCirculacao($circulacao, $this->base);
            if ($v == 0) {
                $circulacaoDAO->insCirculacao($circulacao, $this->base);
            }
            $idCirculacaoArray[] = array("idCirculacao" => $circulacao->idCirculacao);
        }
        $dadoCirculacao = array("passageiro"=>$idCirculacaoArray);
        $retCirculacao = json_encode($dadoCirculacao);
        
        return 'SALVOU_' . $retCirculacao;
    }
    
    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina, $this->base);
    }
    
}
