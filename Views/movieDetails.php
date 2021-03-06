<!-- In this VIEW we show the Details of an specific movie (clicked on the dashboard) with their trailer, duration and showing the differents movie shows to buy a ticket -->
<?php
     require_once(VIEWS_PATH."nav.php");
?>
<div class="container menu">
     <div class="grid">
          <div class="dash">
          <div class="narrow">
               <div class="filters">
                    <div class="date_filter">
                    <div class="head_title">Search by date</div>
                    <form action="<?php echo FRONT_ROOT ?>Dashboard/showMoviesByDate" method="GET">
                         <input type="date" id="start" name="date"
                              value="<?php if(isset($date)){echo $date;}else{ echo date("Y-m-d");}?>"
                              min="2018-01-01" max="2022-12-31">
                         <input type="submit" name="" value="Search"/>
                    </form>
                    </div>
                    <div class="head_title">Search by genres</div>
                    <ul class="filter_by">
                         <?php 
                              if(!empty($genreList)){
                                   foreach($genreList as $genre){
                         ?>
                                   <li class="categoria">
                                        <a href="<?php echo FRONT_ROOT?>Dashboard/showMoviesByGenre/<?php echo $genre->getGenreId()?>"><?php echo $genre->getGenreName()?></a>
                                   </li>
                         <?php
                                   }
                              }
                         ?>
                    </ul>
               </div>
          </div>
          <div class="movie_list">
          <ul class="catalogo">
               <?php
                    if($movie && !empty($movie)){
                ?>
                <div class="selected_movie">
                    <div class="movie_details">
                        <div class="media">
                            <img src='http://image.tmdb.org/t/p/w185<?php echo $movie->getPosterPath()?>' alt="Movie Poster">
                        </div>
                        <div class="data">
                            <div class="titulo">
                                <?php echo $movie->getTitle()?>
                            </div>
                            <div class="description">
                                <?php echo $movie->getOverview()?>
                            </div>
                            <div class="details">
                                <p>Duration:<?php echo $movie->getDuration()?></p>
                                <p>Release Date:<?php echo $movie->getReleaseDate()?></p>
                                <p>Original Lenguage:<?php echo $movie->getOriginalLanguage()?></p>

                            </div>
                        </div>
                    </div>  
                    <div class="movie_actions">
                        <div class="trailer">
                            <div class="titulo">
                                Trailer
                            </div>
                            <div class="video">
                                <div class="video_wrapper">
                                    <iframe  src="<?php echo $movie->getTrailerEmbed()?>" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                        
                        <div class="actions">
                            <h3>Get Ticket for this Movie</h3>
                            <?php
                                $options = ''; 
                                $idShow;
                            ?>
                            <form action="<?php echo FRONT_ROOT ?>Ticket/<?php if(!isset($_SESSION['loggedUser'])){ echo 'checkPurchase';}else{ echo 'selectQuantity';}?>" method="post">
                                <div class="select_show">
                                <select name="id_show" id="id_show" required>
                                <?php 
                                    if($showInfoTicket && !empty($showInfoTicket)){
                                        foreach($showInfoTicket as $showInfo){
                                            foreach($showInfo as $key => $value){
                                                if($key != 'id_show'){
                                                    $options.=$value.' ';
                                                    echo $options;
                                                }else{ 
                                                    $idShow = $value;
                                                }
                                            }
                                            echo "<option value='".$idShow."'>".$options."</option>";
                                            $options='';
                                            
                                        }
                                    }
                                    
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <div class="btn_cont">                                        
                                        <input type="submit" value="Buy Tickets" class=" btn_ticket">
                                    </div>
                                </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php
                    }
               ?>
          </ul>
          </div>
          </div>
     </div>
</div>