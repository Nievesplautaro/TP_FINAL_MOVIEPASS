<?php
    require_once(VIEWS_PATH."navAdmin.php");
?>
<div class="container menu">
    <div class="movie_list">
        <ul class="catalogo cine">
            <?php
            $id = -1;
                        foreach($cinemaList as $cinema){
                        $id++;
                        echo "<li class='cinema' >";
                        echo "<div class='element_cine'>";
                            echo "<div onclick=\"location.href='"; echo FRONT_ROOT; echo "Cinema/ShowRegisterView/"; echo $cinema->getCinemaId();echo "'\";  class='card' >"
                            ;
                                echo "<div class='title center'>
                                        ".$cinema->getName()."
                                        </div>
                                        "
                                        ;
                                echo "<div class='data'>
                                        <div class='title center'>
                                        ".$cinema->getPhoneNumber()."
                                        </div>";
                                echo "<div class='title center'>
                                        ".$cinema->getAddress()."
                                        </div>";
                            echo "</div>
                                </div>";?>
                                <div class="delete">
                                <form action="<?php echo FRONT_ROOT?>Cinema/removeCinema" method="GET">
                                    <input type="hidden" value="<?php echo $cinema->getCinemaId() ?>" name="CinemaId">
                                    <button type="submit" class="uk-button uk-button-danger uk-button-small">
                                        <img src="<?php echo IMG_PATH ?>trash.png">
                                    </button>

                                </form>
                                </div>
                            <div class="rooms">
                                <!-- <form action="<?php// echo FRONT_ROOT?>Room/ShowRooms" method="GET">
                                    <input type="hidden" value="<?php //echo $cinema->getCinemaId() ?>" name="CinemaId">
                                    <button type="submit" class="uk-button uk-button-danger uk-button-small">
                                        <img style="width: 50px; height:50px;" src="<?php// echo IMG_PATH ?>RoomIcon.png">
                                    </button>
                                    
                                </form> -->
                                <a href="<?php echo FRONT_ROOT ?>room/ShowRooms/<?php echo $cinema->getCinemaId(); ?>"><img style="width: 50px; height:50px;" src="<?php// echo IMG_PATH ?>RoomIcon.png"></a>
                                </div>
                            <?php
                        echo "</div>";
                        echo "</li>";
                        }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>