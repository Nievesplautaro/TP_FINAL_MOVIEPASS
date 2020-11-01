<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    Use Models\User as User;

    

    class UserController{

        private $userDAO;
        
        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function ShowMenuView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menu.php");
        }

        public function MenuAdmin()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."menuAdmin.php");
        }

        public function ShowRegisterAdmin($message = "")
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerAdmin.php");
        }

        public function ShowMainView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."main.php");
        }

        public function ShowRegisterView()
        {
            require_once(VIEWS_PATH."register.php");
        }

        public function login($email,$password){

            $daoUser= new UserDAO();

            try{
                if($this->UserExist($email)){
                    $user = $daoUser->read($email);
                    if($user->getPassword() == $password){                    
                        $_SESSION["loggedUser"] = $user;
                        $_SESSION["status"] = "on";
                        //$message = "Login Successfully";
                        //Se implementa header ya que con require rompe al volver hacia atras como en tp6
                        if ($user->getUserRole() == 1||$user->getUserRole() == "1"){
                            $_SESSION["admin"] = true;
                            header("location:MenuAdmin");
                        }else{
                            header("location:Menu");
                        }   
                    }else{
                        $error = "01";
                        require_once(VIEWS_PATH."main.php"); 
                    }
                }else{
                    $error = "01";
                    require_once(VIEWS_PATH."main.php");
                }
            }catch(\PDOExeption $ex){
                throw $ex; 
            }

        }

        public function Main (){
            require_once(VIEWS_PATH."main.php");
        }

        public function Menu(){
            require_once(VIEWS_PATH."validate-session.php");
            include(VIEWS_PATH."menu.php");
            
        }

        public function SignUp($username,$pass){
            try{
                if(!$this->UserExist($username))
                {
                    $user = new User($username,$pass);
                    $user->setUserRole(0);
                    $daoUser= new UserDAO(); 

                    //se crean los usuarios sin rol de admin
                    if($daoUser->create($user)){
                        $error = "03";
                    }else{
                        $error = "02";
                    }
                    require_once(VIEWS_PATH."main.php");
                }else{
                    $error = "10";
                    require_once(VIEWS_PATH."register.php");
                }
                
            }catch(\PDOException $ex){
                throw $ex;
            }
            
        }

        public function SignUpAdm($username,$pass){

            try{
                if(!$this->UserExist($username))
                {

                    $user = new User($username,$pass);
                    $user->setUserRole(1);
                    $daoUser= new UserDAO(); 

                    //se crean los usuarios sin rol de admin
                    if($daoUser->create($user)){
                        $error = "05";
                    }else{
                        $error = "06";
                    }
                    //cambiar por llamado a controladora
                    require_once(VIEWS_PATH."menuAdmin.php");
                }else{
                    $error = "01";
                    require_once(VIEWS_PATH."registerAdmin.php");
                }
                
            }catch(\PDOException $ex){
                throw $ex;
            }
            
        }
        /**
        * Chequea el urol de usuario, admin o usuario
        */
        public function isAdmin($user){
        
            /* $daoUser= new UserDAO(); */
        
            try{
                /* $newUser = $daoUser->read($username); */
                if ($user->getUserRole() == 1){
                    return true;
                }else{
                    return false;
                }
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

        /**
        * Chequea el usuario por el nombre
        */
        public function UserExist($username){
        
            $daoUser= new UserDAO();
        
            try{
                if($daoUser->read($username)){
                    return true;
                }else{
                    return false;
                }
            }catch(\PDOException $ex){
                throw $ex;
            }
        }

        
        /**
        * Rompe la session iniciada
        */
        public function logout(){

            session_destroy();

            $message = "Logout Successfully";

            $this->ShowMainView($message);
        }
        
    }
?>