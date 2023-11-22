<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../control/AtualAplicCTR.class.php');
require_once('../model/ColabDAO.class.php');
require_once('../model/EquipDAO.class.php');
require_once('../model/LocalDAO.class.php');
require_once('../model/OcorAtendDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    public function dadosColab($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $colabDAO = new ColabDAO();

            $dados = array("dados"=>$colabDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
            
        }
        
    }

    public function dadosEquip($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $equipDAO = new EquipDAO();

            $dadosEquip = array("dados" => $equipDAO->dados());
            $resEquip = json_encode($dadosEquip);
            
            return $resEquip;
        
        }
        
    }
    
    public function dadosLocal($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $localDAO = new LocalDAO();

            $dadosLocal = array("dados" => $localDAO->dados());
            $resLocal = json_encode($dadosLocal);
            
            return $resLocal;
        
        }
        
    }
    
    public function dadosOcorAtend($info) {

        $atualAplicCTR = new AtualAplicCTR();
        
        if($atualAplicCTR->verifToken($info)){

            $ocorAtendDAO = new OcorAtendDAO();

            $dadosOcorAtend = array("dados" => $ocorAtendDAO->dados());
            $resOcorAtend = json_encode($dadosOcorAtend);
            
            return $resOcorAtend;
        
        }
        
    }
    
}
