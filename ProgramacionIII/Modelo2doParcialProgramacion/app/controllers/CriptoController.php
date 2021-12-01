<?php

require_once './models/Criptomoneda.php';

class CriptoController{

    public function CrearCripto($request, $response, $args){

        $parametros = $request->getParsedBody();
        $cripto = Criptomoneda::CrearCripto($parametros['precio'], $parametros['nombre'], $parametros['imagen'], $parametros['nacionalidad']);

        try{
            $cripto->InsertarCripto();
            $payload = json_encode(array("mensaje" => $cripto));
        }
        catch(Exception $e){
            $payload = json_encode(array("Error" => $e->message));
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ListarCriptos($request, $response, $args){
        
        try{
            $criptos = Criptomoneda::SelectCriptos();
            $payload = json_encode($criptos);
        }
        catch(Exception $e){
            $payload = json_encode(array("Error" => $e->message));
        }        

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ListarCriptosPorNacionalidad($request, $response, $args){
        
        try{
            $criptos = Criptomoneda::SelectCriptosPorNacionalidad($args['nacionalidad']);
            $payload = json_encode($criptos);
        }
        catch(Exception $e){
            $payload = json_encode(array("Error" => $e->message));
        }        

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ListarCriptosPorId($request, $response, $args){
        
        try{
            $criptos = Criptomoneda::SelectCriptosPorId($args['id']);
            $payload = json_encode($criptos);
        }
        catch(Exception $e){
            $payload = json_encode(array("Error" => $e->message));
        }        

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }


}

?>