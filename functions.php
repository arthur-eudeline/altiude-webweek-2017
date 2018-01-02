<?php 

function get_header($title = "Alti'ude", $body_class=""){
    
    global $front_site_links;
    
    $front_site_links = array(
        "accueil" => array(
            "text" => 'Accueil',
            "class" => 'icon-home',
            "href"  => 'index.php',
        ),
        
       "search" => array(
            "text" => 'Toutes nos formules',
            "class" => 'icon-compass',
            "href"  => 'search.php',
        ),
        
        "contact" => array(
            "text" => 'Contact',
            "class" => 'icon-envelope',
            "href"  => 'contact.php',
        ),
        
        "admin" => array(
            "text" => 'Admin',
            "class" => 'icon-user',
            "href"  => 'admin/',
        ),
    );
    
?>

<!DOCTYPE html> 
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title ?></title>

        <!--INCLUDES STYLESHEETS-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" /> 
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-theme.css"/>        
        <link rel="stylesheet" type="text/css" href="css/swiper/swiper.css" />
        <link rel="stylesheet" type="text/css" href="css/swiper/swiper.min.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome-4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/simple-line-icons.css"/>

        <!--CUSTOM STYLESHEETS-->
        <link rel="stylesheet" type="text/css" href="css/style-chloeB.css" />
        <link rel="stylesheet" type="text/css" href="css/style-font.css" />

        <!--INCLUDES SCRIPTS-->
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/swiper/swiper.js"></script>

    </head>

    <body class="<?php echo $body_class; ?>">

        <div class="container-fluid">
            <div class="row navbar">
                <div class="col-xs-6 col-md-4 brand">
                    <a href="index.php"><i class=""></i></a>
                </div>

                <i class="icon-menu hide-md-bef col-xs-6 text-right" id="menu-trig"></i>

                <ul class="col-xs-12 col-md-8 menu-wrapper">
                    <?php foreach($front_site_links as $link){ ?>
                    <li>
                        <a href="<?php echo $link["href"]; ?>" class="text-uppercase"><span><i class="<?php echo $link["class"]; ?>" aria-hidden="true"></i></span><?php echo $link["text"]; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <?php    
}

function get_the_footer($inserts =''){
    echo $inserts;
?>

<!-- FOOTER -->

<script type="text/javascript">
    $(document).ready(function(){
        $("#menu-trig").on("touch click", function(){
            $(this).toggleClass("icon-close");
            $(this).toggleClass("icon-menu");
        });
    });
</script>

<div class="container-fluid footer">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h4>ALTI'UDE</h4>
                    <p>Et olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina sm eomnes tamen quotquot st vt otiosae sint tribus perecundum.</p>
                </div>

                <div class="col-md-4 col-xs-8">
                    <h4>CONTACT</h4>
                    <p>4 rues des Lauriers <br>43 000 Le Puy en Velay</p>
                    <p>04 05 06 07 08 </p>
                    <p>alti’ude@contact.fr</p>
                </div>

                <div class="col-md-2 col-xs-4 text-right">
                    <a href="#"><i class="fa fa-facebook-square fa-1x social-media" aria-hidden="true"></i></a><br>
                    <a href="#"><i class="fa fa-twitter fa-1x social-media" aria-hidden="true"></i></a><br>
                    <a href="#"><i class="fa fa-instagram fa-1x social-media" aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 text-right copyright">
                    <p>2017 - Alti’ude ©</p>
                </div>
            </div>
        </div> 
    </div>
</div>

<!-- /FOOTER -->

</body>
</html>
            
<?php
}

function the_value($value){
    if(isset($value) && !empty($value) && !is_null($value)){
        echo $value;
        return true;
    } else {
        echo '';
        return false;
    }
}


        ?>