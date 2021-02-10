<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/ColabDAO.class.php');
require_once('../model/dao/EquipDAO.class.php');
require_once('../model/dao/LocalDAO.class.php');
require_once('../model/dao/OcorAtendDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    private $base = 2;

    public function dadosColab($versao) {
        
        $versao = str_replace("_", ".", $versao);
        
        $colabDAO = new ColabDAO();
        
        if($versao >= 1.00){
        
            $dados = array("dados"=>$colabDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }

    public function dadosEquip($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $equipDAO = new EquipDAO();

            $dadosEquip = array("dados" => $equipDAO->dados($this->base));
            $resEquip = json_encode($dadosEquip);
            
            return $resEquip;
        
        }
        
    }
    
    public function dadosLocal($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $localDAO = new LocalDAO();

            $dadosLocal = array("dados" => $localDAO->dados($this->base));
            $resLocal = json_encode($dadosLocal);
            
            return $resLocal;
        
        }
        
    }
    
    public function dadosOcorAtend($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $ocorAtendDAO = new OcorAtendDAO();

            $dadosOcorAtend = array("dados" => $ocorAtendDAO->dados($this->base));
            $resOcorAtend = json_encode($dadosOcorAtend);
            
            return $resOcorAtend;
        
        }
        
    }
    
}
