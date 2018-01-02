<?php 

    require_once(dirname(__FILE__)."/../../config.php");

    if(!empty($_POST)){
        
        $values = array( 
            "cat_title"        =>  $_POST["cat_title"], 
            "cat_desc"         =>  $_POST["cat_desc"],
            "cat_icon"        =>  $_POST["cat_icon"],
            "cat_type"        =>  $_POST["cat_type"],
        );
        
        $requete = $DB->prepare('INSERT INTO `categories` (cat_title, cat_desc, cat_icon, cat_type) VALUES (:cat_title, :cat_desc, :cat_icon, :cat_type);');
        $requete->execute($values);
        $id = $DB->lastInsertId();
        
        
    } else {
        die("oui");
    }

    header("Location:edit-cat.php?state=edit&cat-id=".$id);

?>