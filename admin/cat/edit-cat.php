<?php 

require_once(dirname(__FILE__)."/../../admin-functions.php");
require_once(dirname(__FILE__)."/../../config.php");


if(isset($_GET["state"]) && !is_null($_GET["state"]) && $_GET["state"] === "new"){

    get_admin_header("Créer une catégorie", 1);
    $state_word = "Créer";
    $save_word = "Publier";

    $post = array(
        'cat_title' => '',
        'cat_desc'     => '',
        'cat_icon'    => '',
    );

} else if (isset($_GET["state"]) && !is_null($_GET["state"]) && $_GET["state"] === "edit" && isset($_GET["cat-id"]) && !is_null($_GET["cat-id"])){

    get_admin_header("Éditer une catégorie", 1);
    $state_word = "Éditer";
    $save_word = "Mettre à jour";

    $requete = $DB->query("SELECT * FROM `categories` WHERE cat_ID = {$_GET["cat-id"]} ");
    $post = $requete->fetch(PDO::FETCH_ASSOC);

}

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
                            <div class="col-12">
                                <h4 class="card-title"><?php echo $state_word; ?> une catégorie </h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if($_GET["state"] == "new"){ ?>
                        <form method="post" class="row mb-5 mt-2" action="add-new-cat-script.php" enctype="multipart/form-data">
                            <?php } else { ?>
                            <form method="post" class="row mb-5 mt-2" action="edit-cat-script.php" enctype="multipart/form-data">
                                <?php } ?>

                                <div class="col-12">
                                    <label class="form-group">
                                        <span class="big">Titre de la catégorie :</span>
                                        <input type="text" placeholder="Titre de la page..." name="cat_title" required maxlength="255" class="form-control" value="<?php echo $post["cat_title"]; ?>">
                                    </label> 
                                </div> 

                                <div class="col-12 col-md-6 mt-2 mb-3">
                                    <label class="form-group">
                                        Description de la catégorie
                                        <textarea name="cat_desc" class="form-control" placeholder="Une brève description de la catégorie qui donnera plus d'information aux visiteurs lors de leur visite..."><?php echo $post["cat_desc"]; ?></textarea>
                                    </label>
                                </div> 

                                <label class="col-12 col-md-6 mt-2 mb-3">

                                    Icône :
                                    <div class="input-group">
                                        <input type="text" name="cat_icon" value="<?php echo $post["cat_icon"]; ?>" placeholder="Icône de la catégorie..." class="form-control">
                                        <span class="input-group-addon">
                                            <i class="fa fa-file-image-o"></i> 
                                        </span>
                                    </div>
                                    <em>coller seulement la classe fa (ex : fa-eye), <a href="http://fontawesome.io/icons/" target="_blank">voir les icônes</a></em>
                                </label>
                                
                                <label class="col-12 mt-2 mb-3">

                                    Type de catégorie :
                                    <select class="form-control" name="cat_type">
                                        <option selected disabled>Type de la catégorie</option>
                                        
                                        <option value="activite" <?php if(isset($post["cat_type"]) && $post["cat_type"] == "activite"){ echo "selected"; } ?>><b>Type d'activités</b> (ex : Sport, Gastronomie, ...)</option>
                                        <option value="groupe" <?php if(isset($post["cat_type"]) && $post["cat_type"] == "groupe"){ echo "selected"; } ?>>Pour un certain <b>type de groupe</b> (ex: Famille, Couple, ...)</option>
                                        <option value="theme" <?php if(isset($post["cat_type"]) && $post["cat_type"] == "theme"){ echo "selected"; } ?>>Type de thème (ex : Médiéval, Mythes et Légendes, ... )</option>
                                        <option value="environnement" <?php if(isset($post["cat_type"]) && $post["cat_type"] == "environnement"){ echo "selected"; } ?>>Type d'environnement (ex : Nature, Ville, ... )</option>
                                    </select>
                                </label>


                                <div class="col-12 mt-5 text-center">
                                    <?php if(isset($_GET["cat-id"])){ ?>
                                    <input type="hidden" name="cat_ID" value="<?php echo $_GET["cat-id"]; ?>">
                                    <?php } ?>
                                    <button type="submit" class="primary-outline-btn custom-btn"><?php echo $save_word; ?></button>
                                </div>



                
                        </form>
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