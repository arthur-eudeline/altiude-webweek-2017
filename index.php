<?php 

require('config.php');
require('functions.php');

$requete = $DB->query('SELECT * FROM categories WHERE cat_type="activite" ORDER BY categories.cat_type');
$cats_act = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $DB->query('SELECT * FROM categories WHERE cat_type="groupe" ORDER BY categories.cat_type');
$cats_group = $requete->fetchAll(PDO::FETCH_OBJ);

get_header("Alti'tude", "page-accueil");

?>     

<!-- HEADER SLIDE -->
<div class="container-fluid" id="bg">
    <div class="row">

        <form class="container header-form" method="get" action="search.php">
            <!-- ICI ON MET LE FORMULAIRE -->
            <div class="row">
                <div class="col-xs-12 box-shadow swiper-form">
                    <h2>Découvrez quel site est fait pour vous !</h2>
                    <div class="swiper-container" id="swiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">

                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="categorie-title">Combien de temps partiriez-vous à l'aventure ?</p>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="1" checked>
                                                <span>1 jour</span>
                                            </label>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="2">
                                                <span>2 jours</span>
                                            </label>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="3">
                                                <span>3 jours</span>
                                            </label>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="4">
                                                <span>4 jours</span>
                                            </label>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="5">
                                                <span>5 jours</span>
                                            </label>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="6">
                                                <span>6 jours</span>
                                            </label>
                                            <label class="custum-radio">
                                                <input type="radio" name="duree" value="7">
                                                <span>7 jours</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="swiper-slide">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="categorie-title">Qu'aimeriez-vous faire durant votre séjour ?</p>
                                            <?php foreach($cats_act as $cat){ ?>
                                            <input type="checkbox" name="type[]" value="<?php echo $cat->cat_ID; ?>" id="cat-<?php echo $cat->cat_ID; ?>" class="custom-check">
                                            <label for="cat-<?php echo $cat->cat_ID; ?>" class="custom-check">
                                                <?Php echo $cat->cat_title; ?>
                                                <i class="fa <?php echo $cat->cat_icon; ?>"></i>   
                                            </label>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="categorie-title">Viendriez-vous ...</p>
                                            <?php foreach($cats_group as $cat){ ?>
                                            <input type="checkbox" name="type[]" value="<?php echo $cat->cat_ID; ?>" id="cat-<?php echo $cat->cat_ID; ?>" class="custom-check">
                                            <label for="cat-<?php echo $cat->cat_ID; ?>" class="custom-check">
                                                <?Php echo $cat->cat_title; ?>
                                                <i class="fa <?php echo $cat->cat_icon; ?>"></i>   
                                            </label>

                                            <?php } ?>
                                        </div>
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-blanc" style="margin-left:10px;">rechercher</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div id="pagination"></div>

                    <div class="text-right">
                        <button type="button" id="next-btn" class="btn btn-vert btn-form"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if(!empty($tab_res)){ ?>
<!-- CES FORMULES SONT FAITES POUR VOUS -->
<div class="container">
    <div class="row">
        <div class="proposition">
            <div class="col-sm-8 col-xs-12"> <!-- TITRE -->
                <hr style="height: 1px; width: 50px; border: 1px solid #39CA75; background-color:#39CA75;"  align="left";>
                <h2>CES FORMULES SONT FAITES POUR VOUS !</h2>
                <p>Selectionnez la formule de votre choix et partez à l’aventure.</p>
            </div>

            <div class="col-sm-4 col-xs-12 text-center btn-plus"> <!-- Bouton afficher plus : qui reirige vers la page recherche -->
                <a href="<?php echo $front_site_links["search"]["href"]; ?>" class="btn btn-blanc">afficher plus de résultats...</a>
            </div>
        </div>
    </div>
</div>

<!-- SWIPER -->
<div class="container search-research">
    <div class="row">
        <?php foreach($tab_res as $res){ ?>
            <div class="col-md-4 col-xs-12"> <!-- exemple de formule proposée -->
            <div class="formule-proposee box-shadow">
                <div class="row">
                    <div class="col-sm-12 image">
                        <!-- IMAGE -->
                        <h2><?php echo $res->post_title ?></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 info"> <!-- info -->
                        <div class="col-xs-6 ">
                            <h2><?php echo $res->post_price; ?>€<sup>/pers</sup></h2>
                        </div>

                        <div class="col-xs-6 text-right">
                            <h4><?php echo $res->post_duree; ?> JOURS</h4>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6 col-xs-12 text-center">
                        <div class="row">
                            <button type="button" class="col-xs-12 btn btn-vert">réserver</button> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12 text-center">
                        <div class="row">
                            <button type="button" class="col-xs-12 btn btn-blanc"><i class="fa fa-eye" aria-hidden="true"></i><span class="hide-desktop"> voir plus</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


    <div class="col-sm-1"> <!-- bouton swiper vers la droite -->
    </div>
</div>
<?php } ?>


<!-- QU'EST CE QU'ALTI'UDE -->


<div class="container-fluid explain">    
    <div class="row title-explain">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <hr style="height: 1px; width: 50px; border: 1px solid #39CA75; background-color:#39CA75;"  align="left";>
                    <h2 class="col-md-12"> ALTI'UDE QU'EST CE QUE C'EST ? </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 box-explain box-shadow">
                <img class="col-md-6 col-xs-12 image" src="image/CatheFaceIncline.png">
                <!-- IMAGE -->       

                <div class="col-md-offset-6 col-md-6 col-xs-12 text-wrapper">
                    <div class="row">
                        <div class="col-xs-12">
                            <p><i class="fa fa-binoculars fa-2x" aria-hidden="true"></i></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h4>C'EST D'ABORD UNE DÉCOUVERTE</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <p>La Haute-Loire s’affiche comme un département de nature avec des paysages variés et étonnants, dont certains ont pour particularité d’être d’anciens massifs volcaniques. L’eau coule ici en abondance, la faune et la flore sont remarquables, et les Auvergnats ont pris conscience de la richesse qu’ils avaient à transmettre.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 box-explain box-shadow">
                <img class="col-md-6 col-md-offset-6 col-md-push-6 col-xs-12 image" src="image/LacBleuLac.png">
                <!-- IMAGE -->

                <div class="col-md-6 col-xs-12 text-wrapper">
                    <div class="row">
                        <div class="col-xs-12">
                            <p><i class="fa fa-map-signs fa-2x" aria-hidden="true"></i></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h4>MAIS AUSSI UNE AVENTURE</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <p>Sitôt vos valises défaites vous voilà fin prêt à vous lancer dans les émotions grandeur nature !</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 box-explain box-shadow">
                <img class="col-md-6 col-xs-12 image" src="image/img5.jpg">
                <!-- IMAGE -->         

                <div class="col-md-6 col-md-offset-6 col-xs-12 text-wrapper">
                    <div class="row">
                        <div class="col-xs-12">
                            <p><i class="fa fa-glass fa-2x" aria-hidden="true"></i></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <h4>C’EST DE LA GASTRONOMIE</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <p>Grâce à une cuisine de terroir mais aussi gastronomique, les chefs se distinguent en Auvergne. Préparez-vous à de succulentes dégustations, autour de la cuisine auvergnate basée sur la qualité des produits locaux. Dans ce domaine, l’Auvergne a beaucoup à offrir : lentilles, fromages AOP, Viande du Fin Gras du Mézenc, champignons, salaisons…  </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 

get_the_footer('<script>
    var mySwiper = new Swiper("#swiper", {

        pagination: {
            el: "#pagination",
            type: "bullets",
        },
        navigation : {
            nextEl: "#next-btn"
        }

    });
</script>'); 

?>
