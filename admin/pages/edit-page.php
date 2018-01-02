<?php 

require_once(dirname(__FILE__)."/../../admin-functions.php");
require_once(dirname(__FILE__)."/../../config.php");

$inserts = array(
    "<script src='../js/tinymce/tinymce.min.js'></script>",
    "<script type='text/javascript'>
        $(document).ready(function(){
            tinymce.init({
                selector : '#text-editor',
                content_css : 'planning-stylesheet.css, ../../css/font-awesome.min.css',
                height: 500,
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | start_btn new_btn',
                setup: function(editor){
                    editor.addButton('start_btn', {
                      text: 'Débuter le planning',
                      icon: false,
                      onclick: function () {
                        editor.insertContent('<div class=\"col-sm-offset-2 col-md-8 planning\"><h2 class=\"title-planning\">Planning du séjour</h2><p class=\"teaser\">Une super phrase d\'accroche</p></div>');
                      }
                    });
                    
                    editor.addButton('new_btn', {
                      text: 'Insérer une nouvelle étape',
                      icon: false,
                      onclick: function () {
                        editor.insertContent('<div class=\"col-md-7\"><h3>L\'heure de l\'étape</h3><h4>Libellé de l\'étape</h4><p>Super texte descriptif de la mort qui tue.</p></div><p>[à supprimer, sert juste à pouvoir insérer d\'autres étapes]</p>', {paste:true, merge: true});
                      }
                    });
                  
                  },
                  
                  
            });
            
        });
    </script>"
);

$requete = $DB->query("SELECT cat_ID, cat_title, cat_icon FROM `categories` WHERE 1");
$cats = $requete->fetchAll(PDO::FETCH_ASSOC);


if(isset($_GET["state"]) && !is_null($_GET["state"]) && $_GET["state"] === "new"){

    get_admin_header("Créer une page", 1, $inserts);
    $state_word = "Créer";
    $save_word = "Publier";

    $post = array(
        'post_title' => '',
        'post_content'  => '',
        'post_desc'     => '',
        'post_price'    => '',
        'post_duree'    => '',
        'post_product_link' => '',
        "post_cover_pics" => '',
    );


} else if (isset($_GET["state"]) && !is_null($_GET["state"]) && $_GET["state"] === "edit" && isset($_GET["page-id"]) && !is_null($_GET["page-id"])){

    get_admin_header("Éditer une page", 1, $inserts);
    $state_word = "Éditer";
    $save_word = "Mettre à jour";

    $requete = $DB->query("SELECT * FROM `post` WHERE post_ID = {$_GET["page-id"]}");
    $post = $requete->fetch(PDO::FETCH_ASSOC);

    $requete = $DB->query("SELECT cat_ID FROM cat_link WHERE post_ID = {$_GET["page-id"]}");
    $cats_linked = $requete->fetchAll(PDO::FETCH_ASSOC);
    for($i= 0; $i < count($cats_linked); $i++){
        $cats_link[$i] = $cats_linked[$i]["cat_ID"];
    }

    $post["post_cover_pics"] = json_decode($post["post_cover_pics"], true);

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
        <form method="post" class="container-fluid mb-5 mt-2" <?php if($_GET["state"] == "new"){ ?> action="add-new-page-script.php" <?php } else { ?> action="edit-page-script.php" <?php } ?> enctype="multipart/form-data"><div class="animated fadeIn">
            <div class="row">

                <!--MAIN CARD-->
                <div class="col-12 col-md-8 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12">
                                <h4 class="card-title"><?php echo $state_word; ?> une page </h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-12">
                                <label class="form-group">
                                    <span class="big">Titre de la page :</span>
                                    <input type="text" placeholder="Titre de la page..." name="page-title" required maxlength="255" class="form-control" value="<?php echo $post["post_title"]; ?>">
                                </label> 
                            </div> 

                            <div class="col-12 mt-3 mb-2">
                                <label class="form-group">
                                    Description de la formule
                                    <textarea name="description" class="form-control" placeholder="Courte description de la formule a afficher en haut de la page produit et dans les résultats de recherche..."><?php echo $post["post_desc"]; ?></textarea>
                                </label>
                            </div>

                            <div class="col-12 mt-3 mb-5">
                                <h4>Planning de la formule</h4>
                                <textarea id="text-editor" name="content"><?php echo $post["post_content"]; ?></textarea>
                            </div>

                            <div class="col-12">
                                <div class="img-list row">
                                    <h4 class="col-12 mb-4">Images de la page</h4>
                                    <?php foreach(glob('../../uploads/*.*') as $img){ ?>
                                    <div class="col-6 col-md-4" >
                                        <?php if(is_array($post["post_cover_pics"]) && in_array(basename($img), $post["post_cover_pics"])) { ?>
                                        <input type="checkbox" name="cover_pics[]" value="<?php echo basename($img); ?>" class="hidden-check" id="<?php echo basename($img); ?>" checked>
                                        <?php } else { ?>
                                        <input type="checkbox" name="cover_pics[]" value="<?php echo basename($img); ?>" class="hidden-check" id="<?php echo basename($img); ?>" >
                                        <?php } ?>
                                        <label for="<?php echo basename($img); ?>">
                                            <img src="<?php echo $img; ?>">
                                        </label>
                                    </div>
                                    <?php } ?>
                                </div> 
                            </div>
                        </div>

                    </div>
                </div>
                <!--/MAIN-CARD-->

                <!--SIDE CARD-->
                <div class="col-12 col-md-4 col-md-offset-1 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12">
                                <h4 class="card-title">Paramètres</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-12 mb-2">
                                <label class="form-group">
                                    Prix de la formule en €
                                    <div class="input-group">
                                        <input type="number" name="price" placeholder="Prix de la formule en €..." class="form-control text-right" min="0" value="<?php echo $post["post_price"]; ?>" style="padding-right: 0;">
                                        <span class="input-group-addon">
                                            <i class="fa fa-euro"></i>
                                        </span>
                                    </div>
                                </label>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-group">
                                    Lien vers la réservation
                                    <input type="url" name="link" placeholder="Lien vers la réservation de la formule..." class="form-control" value="<?php echo $post["post_product_link"]; ?>">
                                </label>
                            </div>  

                            <div class="col-12 mb-2">
                                <label class="form-group">
                                    Durée de la formule en jours
                                    <div class="input-group">
                                       
                                        <input type="number" name="duree" placeholder="Durée de la formule en jours..." class="form-control text-right" value="<?php echo $post["post_duree"]; ?>" style="padding-right:0;" min="1" max="7">
                                        <span class="input-group-addon">
                                            Jour(s)
                                        </span>
                                    </div>
                                </label>
                            </div> 

                            <div class="col-12 mb-2">
                                <div class="form-group cat-list">
                                    Catégorie de la formule
                                    <hr/>
                                    <div class="cat-list-wrapper">
                                        <?php foreach($cats as $cat) { ?>
                                        <label>
                                            <?php if(isset($_GET["state"]) && $_GET["state"] == "edit" && isset($cats_link)){ ?>
                                            <?php if(is_array($cats_link) && in_array($cat["cat_ID"], $cats_link) ){ ?>
                                            <input type="checkbox" name="cats[]" value="<?php echo $cat["cat_ID"]; ?>" checked>
                                            <?php } else { ?>
                                            <input type="checkbox" name="cats[]" value="<?php echo $cat["cat_ID"]; ?>">
                                            <?php }} else { ?>
                                            <input type="checkbox" name="cats[]" value="<?php echo $cat["cat_ID"]; ?>">
                                            <?php } ?>
                                            <?php if(!empty($cat["cat_icon"])){ ?>
                                                <i class="fa <?php echo $cat["cat_icon"]; ?>"></i> 
                                            <?php } ?>
                                            <?php echo $cat["cat_title"]; ?>
                                            
                                        </label>
                                        <?php } ?>
                                    </div>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <a class="secondary-outline-btn custom-btn" href="../cat/edit-cat.php?state=new">Ajouter une catégorie</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2 mb-5 text-center">
                            <?php if(isset($_GET["page-id"])){ ?>
                            <input type="hidden" name="post_ID" value="<?php echo $_GET["page-id"]; ?>">
                            <?php } ?>
                            <button type="submit" class="primary-outline-btn custom-btn"><?php echo $save_word; ?></button>
                        </div>
                    </div>
                </div>
                <!--SIDE CARD-->

            </div>

            </div></form>
        <!-- /.conainer-fluid -->

    </main>

</div>

<script type="text/javascript" src="../js/plupload/plupload.full.min.js"></script>
<script type="text/javascript">
    var uploader = new plupload.Uploader({
        runtimes : 'html5',
        containes : 'uploader',
        browse_button : 'browse',
        drop_element: "droparea",
        url : 'uploader.php',
        multipart : true,
        urlstream_upload : true,
        //                multipart_params:{directory: 'test'},
        resize: {width: 1280, height: 720, quality: 90},
        filters : {
            mime_types : [
                {title : 'Images', extensions : 'jpg,gif,jpeg,png'}
            ],
            //                    max_file_size : 2000000,
            max_file_size : "2M",
            prevent_duplicates : true,
        }
    });

    uploader.init();

    uploader.bind('FilesAdded', function(up, files){
        var filelist = $('#filelist');
        for(var i in files){
            var file = files[i];
            filelist.prepend('<li id="'+file.id+'" class="file row"><div class="col-12 col-md-8">'+file.name+'</div><div class="progressbar col-12 col-md-2"><div class="progress"></div></div></div></li>');
        }
        $("#droparea").removeClass('is-hovered');
        uploader.start(); 
        //                uploader.refresh();
    });

    uploader.bind("UploadProgress", function(up, file){
        $("#"+file.id).find('.progress').css('width', file.percent+'%');
        console.log(file.percent);
    });

    uploader.bind("FileUploaded", function(up, file, response){
        data = $.parseJSON(response.response);
        //                data = response;
        console.log(data);
        //                console.log(response);
        if(data.error == true){
            window.alert(data.message);
        } else {
            //à mettre quand c'est bon, genre supprimer la progress bar
            $('#'+file.id).replaceWith(data.html);
        }
    });

    $("#droparea").bind({
        dragover : function(e){
            $(this).addClass('is-hovered');
        },
        dragleave : function(e){
            $(this).removeClass('is-hovered');
        }
    });

    uploader.bind("Error", function(up, err){
        window.alert(err.message);
        $("#droparea").removeClass("is-hovered");
        uploader.refresh();
    });

    //suppression 
    $(".delete").on('click', function(e){
        e.preventDefault();
        if(confirm('Voulez-vous réellement supprimer ce fichier ?')){
            $.get('uploader.php', {action: 'delete', file : $(this).attr('href')});
            $(this).parent().parent().slideUp();
            //ajouter suppression de la div;
        }
    });

</script>

<?php 
get_admin_footer(1);
?>