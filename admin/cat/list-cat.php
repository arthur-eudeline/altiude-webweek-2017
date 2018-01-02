<?php 

require_once(dirname(__FILE__)."/../../admin-functions.php");
require_once(dirname(__FILE__)."/../../config.php");

get_admin_header("Pages du site", 1);

$requete = $DB->query('SELECT * FROM categories WHERE 1');
$posts = $requete->fetchAll(PDO::FETCH_OBJ);

?>

        <!--BODY-->
        <div class="app-body">
           
            <div class="sidebar">
                <!--MENU SIDEBAR-->
                <?php sidebar_menu('see-page', 1); ?>
                <!--MENU SIDEBAR-->
            </div>

            <!-- Main content -->
            <main class="main">
               
                <!--MAIN CONTENTE AREA-->
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        
                        <div class="card mt-5">
                          <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8 col-xs-12 pull-md-4">
                                        <h4 class="card-title">Pages </h4>
                                    </div>

                                    <div class="col-md-4 col-xs-12 push-md-8 text-right">
                                        <a href="edit-page.php?state=new" class="secondary-outline-btn custom-btn">Ajouter une page</a>
                                    </div>
                              </div>
                          </div>
                          
                           <div class="card-body">
                               
                               <?php foreach($posts as $post){ ?>
                               <div class="row mb-2 mt-2">
                                   
                                    <div class="col-12 col-md-8">
                                        <h2><?php echo $post->cat_title; ?></h2>
                                        <p><?php echo $post->cat_desc; ?></p>
                                    </div>
                                    
                                    <div class="col-12 col-md-4 text-md-right">
                                        <a href="edit-cat.php?state=edit&cat-id=<?php echo $post->cat_ID; ?>" class="primary-outline-btn custom-btn mt-1 mb-2">Éditer la catégorie</a>
                                    </div>    
                                    
 
                               </div>
                               <?php } ?>
                               
                           </div>
                            
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.conainer-fluid -->
                
            </main>

        </div>
        
<?php 
get_admin_footer(1);
?>