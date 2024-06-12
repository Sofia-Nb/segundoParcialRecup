<?php
class ContratoViaWeb extends Contrato{
    private $porcentajeDescuento = 10;

        // Constructor
        public function __construct($fechaInicio, $fechaVnecimineto, $objPlan, $costo, $seRenueva, $objCliente, $porcentajeDescuento){
            parent::__construct($fechaInicio, $fechaVnecimineto, $objPlan, $costo, $seRenueva, $objCliente);
            $this->porcentajeDescuento = $porcentajeDescuento;
        }
    
        // Set
        public function setPorcentajeDescuento($porcentajeDescuento) {
            $this->porcentajeDescuento = $porcentajeDescuento;
        }

        // Get
        public function getPorcentajeDescuento() {
            return $this->porcentajeDescuento;
        }

        public function calcularImporte(){
            $costo = parent::calcularImporte();
            $porcDescuento = $this->getPorcentajeDescuento();
            $descuento = $costo * ($porcDescuento / 100);
            $costoConDescuento = $costo - $descuento;
            
            return $costoConDescuento;
        }
}
