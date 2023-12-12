<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/ViagemDAO.class.php');
/**
 * Description of ViagemCTR
 *
 * @author anderson
 */
class ViagemCTR {
    
    public function salvarDados($info) {

        $dados = $info['dado'];
        
        $jsonObjViagem = json_decode($dados);
        $dadosViagem = $jsonObjViagem->viagem;
        $ret = $this->salvarViagem($dadosViagem);

        return $ret;
        
    }
    
    private function salvarViagem($dadosViagem) {
        $viagemDAO = new ViagemDAO();
        $idViagemArray = array();
        foreach ($dadosViagem as $viagem) {
            $v = $viagemDAO->verifViagem($viagem);
            if ($v == 0) {
                $viagemDAO->insViagem($viagem);
            }
            $idViagemArray[] = array("idViagem" => $viagem->idViagem);
        }
        $dadoViagem = array("viagem"=>$idViagemArray);
        $retViagem = json_encode($dadoViagem);
        
        return 'SALVOU_' . $retViagem;
    }
       
}
