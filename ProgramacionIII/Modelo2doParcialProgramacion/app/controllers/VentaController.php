<?php

require_once './models/VentaCripto.php';
require_once './utils/Archivador.php';

class VentaController{

    public function CrearVenta($request, $response, $args){

        $parametros = $request->getParsedBody();
        $venta = VentaCripto::CrearVenta($parametros['cantidad'], $parametros['idCripto']);
    
        try{
            $venta->InsertarVenta();
            $payload = json_encode(array("mensaje" => $venta));
        }
        catch(Exception $e){
            $payload = json_encode(array("Error" => $e->message));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
    

}