<?php

    namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    Use Models\Room as Room;

    class RoomController{

        private $roomDAO;


        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowEditView($id_cinema)
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."editRoom.php");

        }

        public function ShowRegisterRoom($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerRoom.php");
        }

        public function showRooms(){
            $roomList = array();
            $roomList = $this->roomDAO->readRooms();
            $query = $_SERVER["QUERY_STRING"];

            if($query){
                $id_cinema = str_replace("url=Room/ShowRooms&name=", "", $query);
            }
            if($id_cinema){
                $cinema = $this->cinemaDAO->Read($id_cinema);
            }
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomManagment.php");
        }


        /*      ESTA FUNCION AGREGA UNA SALA A UN CINE */
        public function addRoom($id_cinema){
            require_once(VIEWS_PATH."validate-session.php");
                if($id_cinema){
                    $roomName = $_POST['room_name'];
                    $capacity = $_POST['capacity'];
                    $price = $_POST['price'];
                    $cinema = $this->cinemaDAO->Read($id_cinema);

                    $room = new Room($roomName, $capacity, $price, $cinema);
                    
                    $this->roomDAO->create($room);
                    /* ESTE SCRIPT SIRVE DE ALGO=? */
                    echo '<script language="javascript">alert("Your Room Has Been Added Successfully");</script>';  
                }
            $this->showRooms(); 
        }
        
        public function Delete(){

            $query = $_SERVER["QUERY_STRING"];

            if($query){
                $id_room = str_replace("url=Room/Delete&", "", $query);
            }
            if($id_room){
                try{

                    $this->roomDAO->Delete($id_room);
    
                }catch(\PDOException $ex){
                    throw $ex;
                } 
            }
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomManagment.php");
        
        }

    }

?>