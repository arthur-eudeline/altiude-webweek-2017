<?php 

    require_once(dirname(__FILE__)."/../../config.php");

    if(!empty($_POST)){
        
        $values = array(
            "cat_title"        =>  $_POST["cat_title"], 
            "cat_desc"         =>  $_POST["cat_desc"],
            "cat_ID"           =>  $_POST["cat_ID"],
            "cat_icon"         =>  $_POST["cat_icon"],
             "cat_type"        =>  $_POST["cat_type"],
        );
        
        
        $requete = $DB->prepare('UPDATE `categories` SET cat_title = :cat_title, cat_desc = :cat_desc, cat_icon = :cat_icon, cat_type = :cat_type  WHERE cat_ID = :cat_ID');
        $requete->execute($values); 
        
    } else {
        die("oui");
    }

    header("Location:edit-cat.php?state=edit&cat-id=".$_POST["cat_ID"]);

?>