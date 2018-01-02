<?php 

require('functions.php');
require('config.php');
get_header("Formule.php", "page-formule");

//si GET est bien saisi, qu'il n'est pas vide et que c'est un nombre
if(isset($_GET["page-id"]) && !empty($_GET["page-id"]) && is_numeric($_GET["page-id"])){

    $requete = $DB->query("SELECT * FROM post WHERE post_ID = {$_GET["page-id"]}");
    $post = $requete->fetch(PDO::FETCH_OBJ);
    $post->post_cover_pics = json_decode($post->post_cover_pics, true);
    
    $rand = rand(0, (count($post->post_cover_pics)-1) );

    if(empty($post)){
        //404
        die("404");
    } else {

        $requete = $DB->query("SELECT categories.cat_title, categories.cat_desc, categories.cat_icon FROM cat_link, categories WHERE cat_link.post_ID = {$_GET["page-id"]} AND cat_link.cat_ID = categories.cat_ID");
        $cats_linked = $requete->fetchAll(PDO::FETCH_ASSOC);

    }
}


?>        
<div class="container-fluid header-slide" style="background-image:url(uploads/<?php echo $post->post_cover_pics[$rand]; ?>)">
    <div class="row">

        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <!--TIRE-->
                            <h3><?php echo $post->post_title; ?></h3>
                            <?php if(!empty($cats_linked)){ ?>
                            <p class="icone">
                                <?php foreach($cats_linked as $cat){ if(!empty($cat["cat_icon"])){ ?>
                                <i class="fa <?php echo $cat["cat_icon"]; ?> fa-2x" aria-hidden="true"></i>
                                <?php }} ?>
                            </p>
                            <?php } ?>
                        </div>

                        <div class="col-xs-12 col-md-6 text-right">
                            <h2 class="price-formule"><?php echo $post->post_price; ?>€<sup>/pers</sup></h2>
                            <h2><?php echo $post->post_duree; ?> JOURS</h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <a href="<?php echo $post->post_product_link; ?>" class="btn btn-vert">réserver votre séjour</a>
            </div>
        </div>

    </div>
</div>

<!-- BOX RESUMER DE LA FORMULE CHOISIE -->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="resume box-shadow"> 
                <div class="row">
                    <div class="col-sm-8 colonne-resume"><!-- résumé -->

                        <hr style="height: 1px; width: 30px; border: 1px solid #39ca74; background-color:#39ca74;"  align="left";>
                        <h2><?php echo $post->post_title; ?></h2>
                        <!--<h4>Les secrets de Lyon</h4>-->
                        <p><?php echo $post->post_desc; ?></p>
                    </div>

                    <div class="col-sm-4 colonne-eval"> <!-- icones + evaluation de la formule -->
                        <?php if(!empty($cats_linked)){ ?>
                        <h3>Thèmes et activités</h3>
                        <?php foreach($cats_linked as $cat){ ?>
                        <div class="row">
                            <?php if(!empty($cat["cat_icon"])){ ?>
                            <div class="col-xs-2">
                                <i class="fa <?php echo $cat["cat_icon"]; ?> fa-1x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-10">
                                <p><?php echo $cat["cat_title"]; ?></p>
                            </div>   
                            <?php } else { ?>
                            <div class="col-xs-offset-2 col-xs-10">
                                <p><?php echo $cat["cat_title"]; ?></p>
                            </div> 
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <?php } ?>

                        <h3>Évaluation</h3>
                        <p class="note"><i class="fa fa-tripadvisor" aria-hidden="true"></i> | <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-half-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MA FORMULE -->

    <div class="row">
        <div class="col-xs-12">
            <div class="reservation box-shadow">
                <div class="row"> 
                    <div class="col-xs-12">
                        <h2>Ma formule</h2>
                        <p>La réservation se fait via le site <a href="https://www.tripadvisor.fr/" target="_blank"><i class="fa fa-tripadvisor" aria-hidden="true"></i> TripAdvisor</a>. Vous allez être redirigé vers leur site où vous finaliserez la commande (validation de la réservation, paiement...). </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-xs-12">
                        <div class="reservation-info">
                            <div class="col-sm-6 col-xs-8">
                                <h2 class="title-reservation"><?php echo $post->post_title; ?></h2>

                                <div class="col-sm-6 col-xs-12 prix-duree">
                                    <h3><?php echo $post->post_price; ?>€<sup>/pers</sup></h3>
                                </div>
                                <div class="col-sm-6 col-xs-12 prix-duree">
                                    <h4><?php echo $post->post_duree; ?> JOURS</h4>
                                </div>

                            </div>

                            <div class="col-sm-6 col-xs-4 reserv-img">
                                <!-- Image en background dans le CSS -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-xs-12 text-center">
                        <a href="<?php echo $post->post_product_link; ?>" class="btn btn-vert" target="_blank">Réserver sur
                            <i class="fa fa-tripadvisor" aria-hidden="true"></i> Tripadvisor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PLANNING du séjour -->

<div class="container">
    <div class=" content-wrapper">
        <div class="row">


            <div class="col-xs-12">
                <?php echo $post->post_content; ?>
            </div>       

        </div>
    </div>

</div>

<?php get_the_footer(); ?>