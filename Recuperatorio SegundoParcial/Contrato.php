<?php
/*
 
Adquirir un plan implica un contrato. Los contratos tienen la fecha de inicio, la fecha de vencimiento, el plan, un estado (al día, moroso, suspendido), un costo, si se renueva o no y una referencia al cliente que adquirió el contrato.
*/
class Contrato{
    
    //ATRIBUTOS
    private $fechaInicio;   
    private $fechaVencimiento;
    private $objPlan;
    private $estado;  //al día, moroso, suspendido
    private $costo;
    private $seRennueva;
    private $objCliente;

 //CONSTRUCTOR
    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){
    
       $this->fechaInicio = $fechaInicio;
       $this->fechaVencimiento = $fechaVencimiento;
       $this->objPlan = $objPlan;
       $this->estado = 'al dia';
       $this->costo = $costo;
       $this->seRennueva = $seRennueva;
       $this->objCliente = $objCliente;
           

    }


         public function getFechaInicio(){
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio){
         $this->fechaInicio= $fechaInicio;
    }

        public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento($fechaVencimiento){
         $this->fechaVencimiento= $fechaVencimiento;
    }


            public function getObjPlan(){
        return $this->objPlan;
    }

    public function setObjPlan($objPlan){
         $this->objPlan= $objPlan;
    }

   public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
         $this->estado= $estado;
    }

 public function getCosto(){
        return $this->costo;
    }

    public function setCosto($costo){
         $this->costo= $costo;
    }

public function getSeRennueva(){
        return $this->seRennueva;
    }

    public function setSeRennueva($seRennueva){
         $this->seRennueva= $seRennueva;
    }


public function getObjCliente(){
        return $this->objCliente;
    }

    public function setObjCliente($objCliente){
         $this->objCliente= $objCliente;
    }


    public function diasContratoVencido(){
     $fechaVencimiento = $this->getFechaVencimiento();
     $fechaActual = date("d-m-Y");
     $diferencia = 0;
     if ($fechaVencimiento < $fechaActual){
          $diferenciaSegundos = $fechaActual - $fechaVencimiento;
          $diferencia = $diferenciaSegundos / (60 * 60 * 24);
     }
     return $diferencia;
    }

    public function actualizarEstadoContrato(){
     $diferenciaDias = $this->diasContratoVencido();
     $estado = $this->getEstado();
     if ($diferenciaDias < 0){
          $estado = "moroso";
          $this->setEstado($estado);
    }
    if ($diferenciaDias > 10){
     $estado = "suspendido";
          $this->setEstado($estado);
    }
}

public function calcularImporte(){
     $costo = $this->getCosto();
     $estado = $this->getEstado();
     $cantDias = $this->diasContratoVencido();
     if ($estado == "moroso"){
          $multa = ($costo * 10) / 100;
          $multa = $cantDias * $multa;
          $costo = $costo + $multa;
          $this->setEstado("al dia");
          $this->setSeRennueva(true);
     }
     if ($estado == "suspendido"){
          $multa = ($costo * 10) / 100;
          $multa = $cantDias * $multa;
          $costo = $costo + $multa;
          $this->setSeRennueva(false);
     }

     return $costo;
}

public function __toString(){
        //string $cadena
        $cadena = "Fecha inicio: ".$this->getFechaInicio()."\n";
        $cadena = "Fecha Vencimiento: ".$this->getFechaVencimiento()."\n";
        $cadena = $cadena. "Plan: ".$this->getObjPlan()."\n";
        $cadena = $cadena. "Estado: ".$this->getEstado()."\n";
        $cadena = $cadena. "Costo: ".$this->getCosto()."\n";
        $cadena = $cadena. "Se renueva: ".$this->getSeRennueva()."\n";
        $cadena = $cadena. "Cliente: ".$this->getObjCliente()."\n";

 
        return $cadena;
         }
     }    