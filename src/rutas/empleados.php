<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app = new \Slim\App;
//obtener todos los productos
$app->get('/api/empleados', function(Request $request, Response $response){
$consulta = 'SELECT * FROM empleados';
    try{
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $productos = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($productos);
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Info de solo un articulo
$app->get('/api/empleado/{id}', function(Request $request, Response $response){
$id=$request->getAttribute('id');
$consulta = "SELECT * FROM empleados where id='$id'";
    try{
        $db = new db();
        //conexion
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $producto = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        echo json_encode($producto);
    } catch (PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//agregar
$app->post('/api/crear', function(Request $request, Response $response){
        try{
            $db = new db();
            //conexion
            $db = $db->conectar();

            $ejecutar = $db->prepare("INSERT INTO empleados (id,nombre,direccion,telefono) VALUES (:id,:nombre,:direccion,:telefono)");


        //Creamos un array para la inserccion
             $ejecutar->execute(
                array(':id'=>$request->getParam('id'),
                    ':nombre'=>$request->getParam('nombre'),
                    ':direccion'=>$request->getParam('direccion'),                    
                    ':telefono'=>$request->getParam('telefono'))) ;

            echo "Se ha insertado correctamente el empleado";
            //$producto = $ejecutar->fetchAll(PDO::FETCH_OBJ);
            $db=null;
            //echo json_encode($producto);
        } catch (PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    });
//actualizar un producto
$app->put('/api/actualizar/{id}', function(Request $request, Response $response){
    //$cod=$request->getAttribute('cod');
        try{
            $db = new db();
            //conexion
            $db = $db->conectar();
            $ejecutar = $db->prepare("UPDATE empleados SET nombre=:nombre,direccion=:direccion,telefono=:telefono where id=:id ");


        //Creamos un array para la inserccion
             $ejecutar->execute(
                array(':id'=>$request->getAttribute('id'),
                    ':nombre'=>$request->getParam('nombre'),
                    ':direccion'=>$request->getParam('direccion'),                
                    ':telefono'=>$request->getParam('telefono'))) ;

            echo "Se ha actualizado correctamente el empleado";
            //$producto = $ejecutar->fetchAll(PDO::FETCH_OBJ);
            $db=null;
            //echo json_encode($producto);
        } catch (PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    });
    //borrar un producto
$app->delete('/api/eliminar/{id}', function(Request $request, Response $response){
    //$cod=$request->getAttribute('cod');
    //"DELETE FROM proba WHERE Id=3";
        try{
            $db = new db();
            //conexion
            $db = $db->conectar();
            $ejecutar = $db->prepare("DELETE FROM empleados where id=:id ");


        //Creamos un array para la inserccion
             $ejecutar->execute(array(':id'=>$request->getAttribute('id')));

            echo "Se ha borrado correctamente el empleado";
            //$producto = $ejecutar->fetchAll(PDO::FETCH_OBJ);
            $db=null;
            //echo json_encode($producto);
        } catch (PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    });
?>
