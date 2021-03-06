<!-- In this VIEW we show the home page with logins / register -->
<main class="d-flex align-items-center justify-content-center height-100" >
          <div class="content">
               <div class="container">
                    <div class="grid"> 
                         <div class="form_login">
                              <div class= "logo_head"> 
                                   <div class="media">
                                        <a href="">
                                        <img src="<?php echo IMG_PATH ?>favicon.png" alt="Logo">
                                        </a>
                                   </div>
                              </div>
                              <div class="form">                 
                                   <form action="<?php echo FRONT_ROOT ?>User/login" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                                   <?php
                                        if(isset($error)){
                                             switch ($error) {
                                                  case "01":
                                                      echo "<div class='error' >Incorrect Username / Password</div>  ";
                                                      break;
                                                  case "02":
                                                      echo "<div class='error' >Error Sending Data</div>";
                                                      break;
                                                  case "03":
                                                       echo "<div class='valid' >You Have Been Successfully Registered</div>";
                                                       break;
                                                  }
                                        }
                                         
                                   ?>
                                        <div class="form-group">
                                             <label for="">Email</label>
                                             <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Email" title="Email" oninvalid="this.setCustomValidity('Insert a Valid Email')" oninput="this.setCustomValidity('')" required>
                                        </div>
                                        <div class="form-group">
                                             <label for="">Password</label>
                                             <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" title="Password" minlength = "6" maxlength = "16" oninvalid="this.setCustomValidity('The password should have between 6 to 16 characters')" oninput="this.setCustomValidity('')" required >
                                        </div>
                                        <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Login</button>
                                        </div>
                                   </form>
                                   <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="login-form bg-dark-alpha p-5 bg-light">
                                   <div class="btn_cont">
                                        <button class="btn btn-primary btn-block btn-lg" type="submit">Register</button>
                                   </div>
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </main>
