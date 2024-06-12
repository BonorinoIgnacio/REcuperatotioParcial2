<?php
class ContratoWeb extends Contrato{

    private $porcentajeDescuento;

    public function __construct($fechaInicio, $fechaVencimiento, $objPlan, $costo, $seRennueva, $objCliente)
    {
        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan, $costo, $seRennueva, $objCliente);
        $porcentajeDescuento = 0.10;
    }

    public function getPorcentajeDescuento()
    {
        return $this->porcentajeDescuento;
    }

    public function setPorcentajeDescuento($porcentajeDescuento)
    {
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function __toString()
    {
        $salida = parent::__toString();
        $salida .= 'Porcentaje descuento: '. $this->getPorcentajeDescuento();
        return $salida;
    }

    public function calcularImporte(){

        $importeInicial = parent::calcularImporte();
        $importe = $importeInicial - ($importeInicial * $this->getPorcentajeDescuento()) ;
        return $importe;
    }
}