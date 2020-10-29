<?php
    namespace DAO;

    use Models\Show as Show;
    use DAO\Connection as Connection;

    class ShowDAO{

    private $showList = array();
    private $fileName;
    private $connection;
    private $tableName = "shows";


    /**
     * create = add, agrega cines a la base de datos, tabla shows
     */
    public function create($_show){

        $sql = "INSERT INTO show ( movie, id_room, start_time, id_show) VALUES (:show_name, :id_room, :start_time, :id_show)";

        $parameters['movie'] = $_show->getMovie();
        $parameters['id_room'] = $_show->getRoomId();
        $parameters['start_time'] = $_user->getStartTime();
        //indistinto el id de usuario porque es autoincremental, pero sino no lo sube por parametros
        $parameters['id_show'] = 0;

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
    protected function mapear ($value){

        $value = is_array($value) ? $value : [];
        
        $resp = array_map(function($p){
            $show = new show();
            $show->setMovie($p['movie']);
            $show->setRoomId($p['id_room']);
            $show->setStartTime($p['start_time']);            
	return $show;
        }, $value);

        return count($resp) > 1 ? $resp : $resp['0'];

    }

/**
 * Devuelve el cine por el nombre
 */

    public function read($id_show){

        $sql = "SELECT * FROM shows WHERE shows.id_show = :id_show";
        $parameters['id_show'] = $id_show;

        try{
            $this->connection = Connection::getInstance();
            $result = $this->connection->Execute($sql,$parameters);
        }catch(\PDOException $ex){
            throw $ex;
        }
        if(!empty($result)){
            return $this->mapear($result);
        }else{
            return false;
        }

    }

}
?>