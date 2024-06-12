<?php

include_once 'Plan.php';
include_once 'Cliente.php';
include_once 'Contrato.php';
include_once 'ContratoWeb.php';
include_once 'ContratoEnEmpresa.php';
include_once 'Canal.php';
include_once 'EmpresaCable.php';


$objCanal1 = new Canal('musical',100,'si',false);
$objCanal2 = new Canal('musical',200,'no',true);
$objCanal3 = new Canal('musical',300,'no',true);

$colCanales = [$objCanal1,$objCanal2,$objCanal3];

$objPlan1 = new Plan(111,$colCanales,400);
$objPlan2 = new Plan(112,$colCanales,450);

$colPlanes = [$objPlan1,$objPlan2];


$objCliente = new Cliente('nombre',22003,"fai");

$objContratoWeb = new ContratoWeb('01/02/2024','05/08/2024',$objPlan1,5000,true,$objCliente);
$objContratoWeb2 = new ContratoWeb('01/03/2024','05/07/2024',$objPlan2,5020,false,$objCliente);
$objContratoEmpresa = new ContratoEnEmpresa('23/03/2024','20/07/2024',$objPlan2,6000,true,$objCliente);

echo $objContratoWeb->calcularImporte();
echo $objContratoWeb2->calcularImporte();
echo $objContratoEmpresa->calcularImporte();

$colContratos =[$objContratoWeb,$objContratoWeb2,$objContratoEmpresa];
$objEmpresaCable= new EmpresaCable($colContratos,$colPlanes);

$objEmpresaCable->IncorporarPlan($objPlan1);
$objEmpresaCable->IncorporarPlan($objPlan2);

$fechaHoy = date('d/m/Y');
$objEmpresaCable->incorporarContrato($objPlan1,$objCliente,$fechaHoy,$fechaHoy+30,false);
$objEmpresaCable->incorporarContrato($objPlan1,$objCliente,$fechaHoy,$fechaHoy+30,true);

$objEmpresaCable->pagarContrato($objContratoEmpresa);
$objEmpresaCable->pagarContrato($objContratoWeb);

$objEmpresaCable->retornarImporteContratos(111);



