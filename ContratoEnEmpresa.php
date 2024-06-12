<?php
class ContratoEnEmpresa extends Contrato
{


    public function __construct($fechaInicio, $fechaVencimiento, $objPlan, $costo, $seRennueva, $objCliente)
    {

        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan, $costo, $seRennueva, $objCliente);
    }

    public function __toString()
    {
        $salida = parent::__toString();
        return $salida;
    }

    public function calcularImporte()
    {
        $importeCanales = 0;
        $importePlan = $this->getObjPlan()->getImporte();
        $colCanales = $this->getObjPlan()->getColCanales();
        foreach ($colCanales as $unCanal) {
            $importeCanales += $unCanal->getImporte();
        }
        $importeFinal= $importeCanales + $importePlan;
        return $importeFinal;
    }
}
