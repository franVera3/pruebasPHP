<?php
    

function multiplicar($num1,$num2){
    return $num1*$num2;
}

function esNumero($n1,$n2){
    if(is_numeric($n1) && is_numeric($n2)){//verifican si son numeros
        return true;
    }else{
        return false;
    }
}

function mostrarError(){
    echo "<span class='error'>Ingresa solo numeros</span>";
}

function validarCampos(){//verifican que no esten vacios
    if(isset($_POST['numero01']) && isset($_POST['numero02'])){
        $n1=$_POST['numero01'];
        $n2=$_POST['numero02'];
        if(esNumero($n1,$n2)){
            echo multiplicar($n1,$n2);
        }else{
            mostrarError();
        }
    }
}
?>