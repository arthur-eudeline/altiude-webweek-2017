<?php 

require_once(dirname(__FILE__)."/../../admin-functions.php");
require_once(dirname(__FILE__)."/../../config.php");
    
get_admin_header("Images", 1);

    
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
                                        <h4 class="card-title">Ajouter et Supprimer des images</h4>
                                    </div>
                              </div>
                          </div>
                          
                           <div class="card-body">
                                <div id="uploader">
                                    <div id="droparea" class="text-center col-12 mt-2 mb-3">
                                        <div class="browse-wrapper">
                                            <h2>Déposer des fichiers</h2>
                                            <p><b>Taille maximum : 2Mo</b></p>
                                            <a href="#" class="secondary-outline-btn custom-btn" id="browse">Parcourir</a>
                                        </div>

                                    </div>
                                   <ul id="filelist">
                                       <?php foreach(glob('../../uploads/*.*') as $img){ ?>
                                       <li class="file row">
                                           <div class="col-12 col-md-3">
                                               <img src="<?php echo $img; ?>">
                                           </div>
                                           <div class="col-12 col-md-7"><?php echo basename($img); ?></div>
                                           <div class="col-12 col-md-2">
                                               <a href="<?php echo basename($img); ?>" class="delete">Supprimer</a>
                                           </div>
                                       </li>
                                       <?php } ?>
                                   </ul>
                               </div>
                           </div>
                           
                          
                            
                            
                            
                        </div>
                        
                        
                    </div>
                </div>
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
                resize: {width: 1280, height: 720, quality: 90},
                filters : {
                    mime_types : [
                        {title : 'Images', extensions : 'jpg,gif,jpeg,png'}
                    ],
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
                uploader.refresh();
            });
            
            uploader.bind("UploadProgress", function(up, file){
                $("#"+file.id).find('.progress').css('width', file.percent+'%');
            });
            
            uploader.bind("FileUploaded", function(up, file, response){
                data = $.parseJSON(response.response);
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