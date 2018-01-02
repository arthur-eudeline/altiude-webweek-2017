<?php 

require_once(dirname(__FILE__)."/../admin-functions.php");
require_once(dirname(__FILE__)."/../config.php");

get_admin_header();

?>

        <!--BODY-->
        <div class="app-body">
           
            <div class="sidebar">
                <!--MENU SIDEBAR-->
                <?php sidebar_menu('accueil'); ?>
                <!--MENU SIDEBAR-->
            </div>

            <!-- Main content -->
            <main class="main">

                <!--MAIN CONTENTE AREA-->
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        
                        <div class="card mt-5">
                           <div class="card-body">
                               
                               <div class="row">
                                   
                                    <div class="col-12">
                                        <h4 class="card-title">Administration - <?php echo $GLOBALS["site_title"]; ?></h4>
                                    </div>
                                   
                               </div>
                               
                           </div>
                            
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.conainer-fluid -->
                
            </main>

        </div>
        
<?php 
get_admin_footer(0);
?>