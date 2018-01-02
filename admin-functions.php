<?php

function sidebar_menu($active = '', $levels_down = 0){
    
    $path = get_the_path($levels_down);
    
    $links = array(
        'accueil'       => array(
            'slug'      =>  'accueil',
            'nom'       =>  'Accueil',
            'url'       =>  'index.php',
            'icon'      =>  'speedometer',
            'type'      =>  'item',
            'sub'       =>  ''
        ),
        
        'sep contenu'   => array(
            'slug'      =>  'contenu',
            'nom'       =>  'Contenu',
            'url'       =>  '',
            'icon'      =>  '',
            'type'      =>  'title',
            'sub'       =>  ''
        ),  
        
        'pages'         => array(
            'slug'      =>  'pages',
            'nom'       =>  'Pages',
            'url'       =>  'list-page.php',
            'icon'      =>  'doc',
            'type'      =>  'item',
            'sub'       =>  array(
                'add-page' =>  array(
                    'slug'  =>  'add-page',
                    'nom'   =>  'Créer une page',
                    'url'   =>  'pages/edit-page.php?state=new',
                    'icon'  =>  'plus',
                    'type'  =>  'item',
                ),
                'see-page' =>  array(
                    'slug'  =>  'see-page',
                    'nom'   =>  'Voir les pages',
                    'url'   =>  'pages/list-page.php',
                    'icon'  =>  'eye',
                    'type'  =>  'item',
                ),
            )
        ),
        
        'images'    =>  array(
            'slug'  =>  'images',
            'nom'   =>  'Ajouter/Supprimer des images',
            'url'   =>  'pages/image-uploader-page.php',
            'icon'  =>  'picture',
            'type'  =>  'item',
        ),
        
        'categories'    => array(
            'slug'      =>  'cat',
            'nom'       =>  'Catégories',
            'url'       =>  'cat.php',
            'icon'      =>  'drawer',
            'type'      =>  'item',
            'sub'       =>  array(
                'add-cat' =>  array(
                    'slug'  =>  'add-cat',
                    'nom'   =>  'Créer une catégorie',
                    'url'   =>  'cat/edit-cat.php?state=new',
                    'icon'  =>  'plus',
                    'type'  =>  'item',
                ),
                'see-cat' =>  array(
                    'slug'  =>  'see-cat',
                    'nom'   =>  'Voir les catégories',
                    'url'   =>  'cat/list-cat.php',
                    'icon'  =>  'eye',
                    'type'  =>  'item',
                ),
            )
        ),
    );
    //fin $links
    
    
    function active_status($slug, $active){
        if($slug === $active){
            echo "active";
        }
    }
?>
 
<nav class="sidebar-nav">
    <ul class="nav">
        <?php foreach($links as $link){ 
        if(!empty($link["sub"]) && count($link["sub"] > 0)){ ?>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle <?php active_status($link["slug"], $active); ?>" href="#"><i class="icon-<?php echo $link["icon"] ?>"></i> <?php echo $link["nom"] ?></a>
            
            <ul class="nav-dropdown-items">
                <?php foreach($link["sub"] as $sub_link){ ?>
                <li class="nav-<?php echo $sub_link["type"] ?>">
                    <a class="nav-link <?php active_status($link["slug"], $active); ?>" href="<?php echo $path.$sub_link["url"] ?>"><i class="icon-<?php echo $sub_link["icon"] ?>"></i> <?php echo $sub_link["nom"] ?></a>
                </li>
                <?php } ?>
            </ul>
        </li>
        <?php } else if($link["type"] == "title") { ?>
        <li class="nav-title">
            <?php echo $link["nom"] ?>
        </li>
        <?php } else { ?>
        <li class="nav-item">
            <a class="nav-link <?php active_status($link["slug"], $active); ?>" href="<?php echo $path.$link["url"] ?>"><i class="icon-<?php echo $link["icon"] ?>"></i> <?php echo $link["nom"] ?></a>
        </li>
        <?php }
        } // fin foreach
        ?>
    </ul>
</nav>   
<button class="sidebar-minimizer brand-minimizer" type="button"></button>    
    
<?php
    
    }

function the_current_user(){
    echo "John Doe";
}

function get_admin_header($title = 'Administration', $levels_down = 0, $inserts = array()){
    $path = get_the_path($levels_down);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ?></title>

    <!-- Icons -->
    <link href="../<?php echo $path; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="../<?php echo $path; ?>css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
    <!-- Styles required by this views -->
    <link href="../<?php echo $path; ?>css/admin.css" rel="stylesheet">
    
    <script src="../<?php echo $path; ?>js/jquery.min.js"></script>
    
    <?php 
    
        if(!empty($inserts)){
            
            foreach($inserts as $insert){
                echo $insert;
            }
        
        }
    
    ?>

</head> 
  
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
        <!--HEADER-->
        <header class="app-header navbar ">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item d-md-down-none">
                    Bonjour, <?php the_current_user(); ?>
                </li>
                <li class="nav-item d-md-down-none">
                    <a class="nav-link loggout-btn" href="#"><i class="icon-logout"></i> Se déconnecter </a>
                </li>
            </ul>
        </header>
        <!--/HEADER-->
   
    
<?php  
}

function get_admin_footer($levels_down = 0){
    $path = get_the_path($levels_down);
?>

        <footer class="app-footer">
            <span><a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.</span>
            <span class="ml-auto">Powered by <a href="http://coreui.io">CoreUI</a></span>
        </footer>

        <!-- Bootstrap and necessary plugins -->
        <script src="../<?php echo $path; ?>js/popper.js"></script>
        <script src="../<?php echo $path; ?>js/bootstrap.min.js"></script>
        <script src="../<?php echo $path; ?>js/pace.min.js"></script>

        <!-- CoreUI main scripts -->

        <script src="<?php echo $path; ?>js/app.js"></script>

        <!-- Plugins and scripts required by this views -->


    </body>
</html>

<?php 
}

function get_the_path($levels_down = 0){
    $path = '';
    for($i = 0; $i < $levels_down; $i++){
        $path = $path.'../';
    }
    
    return $path;
}

?>