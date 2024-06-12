<?php
include_once 'Canal.php';
include_once 'Cliente.php';
include_once 'ContratoEmpresa.php';
include_once 'ContratoViaWeb.php';
include_once 'Plan.php';
include_once 'EmpresaCable.php';

$objEmpresaCable = new EmpresaCable();

$objCanal1 = new Canal("Noticias", 10000, true, 50);
$objCanal2 = new Canal("Musical", 15000, true, 30);
$objCanal3 = new Canal("deportivo", 1050, false, 50);

$objPlan1 = new Plan (111, [$objCanal1, $objCanal2, $objCanal3], 2000);
$objPlan2 = new Plan (222, [$objCanal1, $objCanal2, $objCanal3], 3000);

$objCliente = new Cliente("unaDenominacion", 21342567751, "unaDireccion");

$fecha1 = new DateTime('2024-06-12');
$fecha2 = new DateTime('2024-06-13');
$fecha3 = new DateTime('2024-06-15'); 

$objContrato1 = new ContratoEmpresa($fecha1, $fecha3, $objPlan2, 20000, true, $objCliente, "al dia");
$objContrato2 = new ContratoViaWeb ($fecha3, $fecha2, $objPlan1, 30000, true, $objCliente, 20, "moroso");
$objContrato3 = new ContratoViaWeb ($fecha3, $fecha1, $objPlan2, 20000, false, $objCliente, 10, "suspendido");

$primero = $objContrato1->calcularImporte();
echo $primero;

$segundo = $objContrato2->calcularImporte();
echo $segundo;

$tercero = $objContrato3->calcularImporte();
echo $tercero;

$fecha4 = new DateTime('2024-07-12');
$objEmpresaCable->incorporarPlan($objPlan2);
$objEmpresaCable->incorporarPlan($objPlan1);
$objEmpresaCable->incorporarContrato($objPlan1, $objCliente, date("d-m-y"), $fecha4, false);
$objEmpresaCable->incorporarContrato($objPlan2, $objCliente, date("d-m-y"), $fecha4, true);

$importe1 = $objEmpresaCable->pagarContrato($objContrato1);
$importe2 = $objEmpresaCable->pagarContrato($objContrato3);

$objEmpresaCable->retornarImporteContratos(111);