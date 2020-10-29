<?php
    namespace DAO;

    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;

    class CinemaDAO{

    private $CinemaList = array();
    private $fileName;
    private $connection;
    private $tableName = "cinemas";


    /**
     * create = add, agrega cines a la base de datos, tabla cinemas
     */
    public function create($_cinema){

        $sql = "INSERT INTO cinemas (cinema_name, address, phone_number, id_cinema) VALUES (:cinema_name, :address, :phone_number, :id_cinema)";

        $parameters['cinema_name'] = $_cinema->getName();
        $parameters['address'] = $_cinema->getAddress();
        $parameters['phone_number'] = $_cinema->getPhoneNumber();
        //indistinto el id de usuario porque es autoincremental, pero sino no lo sube por parametros
        $parameters['id_cinema'] = 0;

        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }

    }


/**
 * Transformamos el listado de usuarios en objetos de la clase usuario
 */
    protected function mapearCine($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $cinema = new Cinema();
            $cinema->setName($p['cinema_name']);
            $cinema->setAddress($p['address']);
            $cinema->setPhoneNumber($p['phone_number']);            
	    return $cinema;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * Devuelve el cine por el nombre
 */

    public function read($cinema_name){

        $sql = "SELECT * FROM Cinemas WHERE Cinemas.cinema_name = :cinema_name";
        $parameters['cinema_name'] = $cinema_name;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCine($result);
        }else{
            return false;
        }

    }

    public function readCinemas(){

        $sql = "SELECT * FROM cinemas";
        

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapearCine($result);
        }else{
            return false;
        }

    }

}
?>