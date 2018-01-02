<?php

$formules = array();

require('functions.php');
require('config.php');
require('search-script.php');

$requete = $DB->query('SELECT * FROM categories WHERE 1 ORDER BY categories.cat_type');
$cats = $requete->fetchAll(PDO::FETCH_OBJ);


get_header("Cercher une formule", "page-recherche");

?>

<!-- CORPS -->
<div class="container-fluid">
    <div class="row">

        <!--FILTRE-->
        <div class="col-md-2 col-xs-12 filter-wrapper">
            <div class="box-shadow filtre row">
                <div class="">
                    <div class=" col-xs-12 title-menu">
                        <h4 id="to-hide-trig">
                            FILTRE <i class="fa fa-angle-down hide-desktop" aria-hidden="true"></i>
                        </h4>
                    </div>

                    <form class="col-xs-12 to-hide" method="get" action="search.php?action=search">
                        <input type="hidden" name="action" value="search">

                        <!-- BARRE DE RECHERCHE -->
                        <div class="input-group search-wrapper">

                            <input type="text" class="form-control" placeholder="Rechercher une offre..." name="keyword" value="<?php echo $keywords; ?>">
                            <span class="input-group-btn">
                                <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>
                        </div>
                        <!-- BARRE DE RECHERCHE -->

                        <!-- DUREE DU SEJOUR -->
                        <div class="range-wrapper">
                            <p class="categorie-title">DURÉE (EN J)</p>
                            <div class="range-progress"></div>
                            <?php if(isset($_GET["duree"]) && is_numeric($_GET["duree"])){ ?>
                            <input type="range" class="range" id="range" name="duree" min="1" max="7" step="1" value="<?php echo $_GET["duree"]; ?>"/>
                            <?php } else { ?>
                            <input type="range" class="range" id="range" name="duree" min="1" max="7" step="1" value="2"/>
                            <?php } ?>
                            <output style="left:<?php echo round((2-1)*(100/6)); ?>%; transform:translateX(-37%);" id="range-value"></output>
                        </div>
                        <!-- DUREE DU SEJOUR -->

                        <?php 
                        $last_cat = '';
                        foreach($cats as $cat){ 
                            $curr_cat = $cat->cat_type;
                            if($curr_cat != $last_cat){
                                echo '<p class="categorie-title">'.$curr_cat.'</p>';
                                $last_cat = $curr_cat;
                            }

                            if(isset($_GET["type"]) && in_array($cat->cat_ID, $_GET["type"])){
                        ?>
                        <input type="checkbox" name="type[]" value="<?php echo $cat->cat_ID; ?>" id="cat-<?php echo $cat->cat_ID; ?>" class="custom-check" checked>
                        <?php } else { ?>
                        <input type="checkbox" name="type[]" value="<?php echo $cat->cat_ID; ?>" id="cat-<?php echo $cat->cat_ID; ?>" class="custom-check">
                        <?php } ?>
                        <label for="cat-<?php echo $cat->cat_ID; ?>" class="custom-check">
                            <?Php echo $cat->cat_title; ?>
                            <i class="fa <?php echo $cat->cat_icon; ?>"></i>   
                        </label>

                        <?php } ?>

                        <div class="text-center">
                            <button type="submit" class="btn btn-vert">Filtrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/FILTRE-->

        <!--RESULTATS DE RECHERCHE-->
        <div class="col-md-offset-1 col-md-8 col-xs-12"> <!-- Contenu à droite -->
            <div class="row bandeau-haut"> <!-- Titre plus recherche -->
                <div class="col-sm-7">
                    <h3>NOS FORMULES POUR VOTRE SÉJOUR</h3>
                    <p>Faites vous plaisir !</p>
                </div>
            </div> <!-- /fin/ Titre plus recherche -->


            <!--LISTE DES FORMULES-->
            <?php 
            foreach($formules as $formule){ 
                $requete = $DB->query("SELECT categories.cat_title, categories.cat_ID, categories.cat_icon FROM cat_link, categories WHERE cat_link.post_ID = {$formule->post_ID } AND cat_link.cat_ID = categories.cat_ID");
                $cats_linked = $requete->fetchAll(PDO::FETCH_ASSOC);   
                
                if(!empty($formule->post_cover_pics) && $formule->post_cover_pics != "null"){
                    $formule->post_cover_pics = json_decode($formule->post_cover_pics, true);
                } else {
                    $formule->post_cover_pics = array('image.jpg');
                }
                $rand = rand(0, (count($formule->post_cover_pics)-1) );
            ?>
            <div class="row" id="form-<?php echo $formule->post_ID; ?>">
                <div class="col-xs-12">
                    <div class="box-shadow box-resultat">
                        <!--IMAGE-->
                        <div class="col-md-8 col-xs-12 col-md-push-4 image">
                            <img src="uploads/<?php echo $formule->post_cover_pics[$rand];?>"> <!-- Image de la formule -->
                            <h3><?php echo $formule->post_title; ?></h3>
                            <?php if(!empty($cats_linked)){ ?>
                            <div class="col-xs-12 icon">
                                <p>
                                    <?php foreach($cats_linked as $cat){ ?>
                                    <i class="fa <?php echo $cat["cat_icon"] ?> fa-2x" aria-hidden="true"></i>
                                    <?php } ?>
                                </p>
                            </div>
                            <?php } ?>
                        </div>
                        <!--/IMAGE-->

                        <!--INFOS-->
                        <div class="col-md-4 col-xs-12 col-md-pull-8 info"> <!-- Info sur la formule -->
                            <div class="row">
                                <h2 class="col-xs-6 col-md-12"><?php echo $formule->post_price; ?>€<sup>/pers</sup></h2>
                                <h4 class="col-xs-6 col-md-12"><?php echo $formule->post_duree; ?> JOUR(S)</h4>
                            </div>
                            <p class="summury"><?php echo $formule->post_desc; ?></p>

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-0 col-xs-8 col-xs-offset-2">
                                    <a herf="<?php echo $formule->post_product_link; ?>" class=" btn btn-vert">réserver</a> 
                                </div>

                                <div class="col-sm-6 col-sm-offset-0  col-xs-8 col-xs-offset-2 text-left">
                                    <a href="formule.php?page-id=<?php echo $formule->post_ID; ?>" class="btn btn-blanc"><i class="fa fa-eye" aria-hidden="true"></i> <span class="hide-desktop">en voir plus</span></a>
                                </div>
                            </div>
                        </div>
                        <!--/INFOS-->
                    </div>
                </div>
            </div>
            <?php } ?>
            <!--FIN LISTE DES FORMULES-->

        </div> <!-- /fin/ Contenu à gauche --> 
        <!--FIN RESULTATS DE RECHERCHE-->
    </div>
</div> <!-- /fin/ container-fluid -->


<script type="text/javascript">
    $(document).ready(function(){
        $("label.list-box").on("touch click", function(){
            $(this).parent("li").toggleClass("is-open");
        });

        $("#range").next().text($("#range").attr("value")); // Valeur par défaut
        var $set = $("#range").val();
        $("#range").parent().find('.range-progress').attr("style", "width: "+Math.round((parseInt($set)-1) * (100/6))+"%;");

        switch($set){
            case "1" :
                console.log("oui");
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-20%);");
                break;

            case "2" :
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-37%);");
                break;

            case "3" :
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-37%);");
                break;

            case "4" :
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-56%);");
                break; 

            case "5" :
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-72%);");
                break;

            case "6" :
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-72%);");
                break;

            case "7" :
                $("#range").next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-90%);");
                break;
                   }

        $("#to-hide-trig").on("click touch", function(){
            $(".to-hide").toggleClass("is-open");
        });

    });
    $(function() {
        $("#range").next().text($("#range").attr("value")); // Valeur par défaut
        $("#range").on("input", function() {
            var $set = $(this).val();
            $(this).next().text($set);
            $(this).parent().find('.range-progress').attr("style", "width: "+Math.round((parseInt($set)-1) * (100/6))+"%;");

            switch($set){
                case "1" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-20%);");
                    break;

                case "2" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-37%);");
                    break;

                case "3" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-37%);");
                    break;

                case "4" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-56%);");
                    break; 

                case "5" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-72%);");
                    break;

                case "6" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-72%);");
                    break;

                case "7" :
                    $(this).next().attr("style", "left :"+Math.round((parseInt($set)-1) * (100/6))+"%; transform:translateX(-90%);");
                    break;
                       }

        });
    });
</script>

<?php

get_the_footer(); 

?>
