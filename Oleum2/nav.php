<div class = "navtop">
            <ul>
                <?php if (isset($_SESSION['loggedin'])) { ?>      
                  <li><a href="clientprofile.php">Client Profile</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['loggedin'])) { ?>      
                  <li><a href="fuelquoteform.php">Fuel Quote Form</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['loggedin'])) { ?>      
                  <li><a href="fuelquotehistory.php">Fuel Quote History</a></li>
                <?php } ?>
                <?php if (!isset($_SESSION['loggedin'])) { ?>
                  <li style="float:right"><a href="Login_Member.php">Member Login/Register</a></li>               
                <?php } ?>
                <?php if (isset($_SESSION['loggedin'])) { ?>    
                  <li style = "float:right"><a href="Logout_Member.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>            
				          
                <?php } ?>
            </ul>
        </div>
