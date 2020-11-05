<?php
    require_once(VIEWS_PATH."nav.php");
?>
<div class="container menu">
    <div class="ticket_list">
        <ul class="my_tickets">
            <?php
            $id = -1;
                if($ticketList && !empty($ticketList)){
                        foreach($ticketList as $ticket){
                        $id++;
            ?>
            <li class="ticket">
                <div class="element_ticket">
                    <div class="header">
                        <img src="<?php echo IMG_PATH?>/favicon.png" alt="Logo"></img>
                    </div>
                    <div class="title">
                            Ticket Data
                    </div>
                    <div class="data">
                            <div class="element">
                                Ticket ID: <?php echo $ticket->getIdTicket()  ?>
                            </div>
                            <div class="element">
                                Show ID: <?php echo $ticket->getIdShow()  ?>
                            </div>
                            <div class="element">
                                User ID: <?php echo $ticket->getIdUser()  ?>
                            </div>
                            <div class="element">
                                Price: <?php echo $ticket->getPrice()  ?>
                            </div>
                    </div>
                </div>
            </li>
            <?php
                        }
                }else{  
                    echo "<div class='Error'>";
                    echo "<div class='empty_cine'><p>Actualmente no tenemos ningun ticket disponible para mostrar.</p><p> Si desea comprar un ticket mire nuestra Cartelera aqui.</p></div>";
                    echo "<div class='button'><a href='";
                    echo FRONT_ROOT;
                    echo"Dashboard/showMovies'>Show Movies</a></div></div>";
                }
            ?>
        </ul>
        </div>
        </div>
    </div>
</div>