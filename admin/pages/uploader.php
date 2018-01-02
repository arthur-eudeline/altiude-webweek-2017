<?php 

function return_bytes($val)
{
    $val  = trim($val);

    $last = strtolower($val[strlen($val)-1]);
    $val  = substr($val, 0, -1); // necessary since PHP 7.1; otherwise optional

    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

if(isset($_GET["action"]) && $_GET["action"] == "delete"){
    unlink('../../uploads/'.$_GET["file"]);
}

if(filesize($_FILES['file']['tmp_name']) > return_bytes(ini_get("upload_max_filesize"))){
    die('{"error" : true, "message" : "La taille du fichier est trop importante."}');
} 

if(file_exists('../../uploads/'.$_FILES['file']['name'])){
    die('{"error" : true, "message" : "Le fichier existe déjà."}');
}

    move_uploaded_file($_FILES['file']['tmp_name'], '../../uploads/'.$_FILES["file"]["name"]);

    $v = '../../uploads/'.$_FILES['file']['name'];
    $html = '<li class="file row"><div class="col-12 col-md-3"><img src="'.$v.'"></div><div class="col-12 col-md-7">'.basename($v).'</div><div class="col-12 col-md-2"> <a href="'.$v.'" class="delete">Supprimer</a></div></li>';
    $html = str_replace('"', '\\"', $html);
    $msg = array(
        'error' => false,
        'html'  => $html,
    );
    $msg = json_encode($msg);

//    die($msg);
    die('{"error" : false, "html" : "'.$html.'"}');


?>


<li class="file">
                                       <div class="col-12 col-md-3">
                                           <img src="<?php echo $img; ?>">
                                       </div>
                                       <div class="col-12 col-md-8"><?php echo basename($img); ?></div>
                                       <div class="col-12 col-md-2">
                                           <a href="<?php echo basename($img); ?>" class="delete">Supprimer</a>
                                       </div>
                                   </li>