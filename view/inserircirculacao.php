<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

require_once('../control/CirculacaoCTR.class.php');

if (isset($info)):

    $circulacaoCTR = new CirculacaoCTR();
    echo $circulacaoCTR->salvarDados($info);
    
endif;
