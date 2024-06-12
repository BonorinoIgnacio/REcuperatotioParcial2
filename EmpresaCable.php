<?php

class EmpresaCable
{

    private $colPlanes;
    private $colContratos;


    public function __construct($colContratos, $colPlanes)
    {
        $this->colContratos = $colContratos;
        $this->colPlanes = $colPlanes;
    }


    public function getColPlanes()
    {
        return $this->colPlanes;
    }

    public function getColContratos()
    {
        return $this->colContratos;
    }

    public function setColPlanes($colPlanes)
    {
        $this->colPlanes = $colPlanes;
    }

    public function setColContratos($colContratos)
    {
        $this->colContratos = $colContratos;
    }

    public function __toString()
    {
        $colContratos = $this->getColContratos();
        $colPlanes = $this->getColPlanes();
        $listaPlanes = '';
        $listaContratos = '';

        foreach ($colContratos as $elemento) {
            $listaContratos .= $elemento . "\n";
        }
        foreach ($colPlanes as $elemento) {
            $listaPlanes .= $elemento . "\n";
        }

        $salida = 'Planes:' . $listaPlanes . "\n" . 'Contratos: ' . $listaContratos;
        return $salida;
    }

    public function incorporarPlan($objPlan)
    {

        $colPlanes = $this->getColPlanes();
        $coincide = false;
        $i = 0;

        while ($i <= count($colPlanes) && $coincide == false) {
            $planes=$colPlanes[$i];
            if ($colPlanes[$i]->getIncluyeMG()!=0) {

                if (
                    $planes->getColCanales()->getTipo()[$i] == $objPlan->getColCanales()->getTipo() &&
                    $planes->getIncluyeMG() == $objPlan->getIncluyeMG()
                ) {
                    $coincide = true;
                }
            } 
            $i++;
        }
        $agregarPlan = array_push($colPlanes, $objPlan);
        $this->setColPlanes($agregarPlan);
    }

    public function incorporarContrato($objPlan, $objCliente, $fechaDesde, $fechaVenc, $esViaWeb)
    {

        if ($esViaWeb) {
            $contrato = new ContratoWeb($fechaDesde, $fechaVenc, $objPlan, 1000, true, $objCliente);
        } else {
            $contrato = new ContratoEnEmpresa($fechaDesde, $fechaVenc, $objPlan, 2000, true, $objCliente);
        }
        $agregar = array_push($this->getColContratos(), $contrato);
        $this->setColContratos($agregar);
    }

    public function retornarImporteContratos($codigoPlan)
    {
        $suma=0;
        $colPlanes = $this->getColPlanes();
        foreach ($colPlanes as $unPlan){

            if($unPlan->getCodigo() == $codigoPlan ){
                $suma += $unPlan->getImporte();
            }
        }
        return $suma;
    }

    public function pagarContrato ($objContrato){

        $objContrato->actualizarEstado();
        $importe = $objContrato->calcularImporte();
        return $importe;
    }

    
}
