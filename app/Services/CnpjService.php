<?php

namespace App\Services;

class CnpjService
{
    public static function validateCnpj(string $cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        $sum  = 0;
        $weight = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0; $i < 12; $i++) {
            $sum += (int) $cnpj[$i] * $weight[$i];
        }
        $remainder   = $sum % 11;
        $digit1 = $remainder > 1 ? 11 - $remainder : 0;

        // Calcula o segundo dígito verificador
        $sum  = 0;
        $weight = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0; $i < 13; $i++) {
            $sum += (int) $cnpj[$i] * $weight[$i];
        }
        $remainder   = $sum % 11;
        $digit2 = $remainder > 1 ? 11 - $remainder : 0;

        // Verifica se os dígitos calculados são iguais aos dígitos informados
        return (int) $cnpj[12] == $digit1 && (int) $cnpj[13] == $digit2;
    }
}
