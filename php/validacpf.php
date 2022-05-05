<?php
    function validaCPF($cpf) {

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($i = 9; $i < 11; $i++) {
            for ($n = 0, $m = 0; $m < $i; $m++) {
                $n += $cpf[$m] * (($i + 1) - $m);
            }
            $n = ((10 * $n) % 11) % 10;
            if ($cpf[$m] != $n) {
                return false;
            }
        }
        
        return true;
    }
?>