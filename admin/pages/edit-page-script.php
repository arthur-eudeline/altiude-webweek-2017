<?php 

    require_once(dirname(__FILE__)."/../../config.php");


    if(!empty($_POST)){
        
        $values = array(
            "post_ID"           =>  $_POST["post_ID"],
            "post_type"         =>  "formule", 
            "post_title"        =>  $_POST["page-title"], 
            "post_desc"         =>  $_POST["description"], 
            "post_content"      =>  $_POST["content"], 
            "post_cover_pics"   =>  json_encode($_POST["cover_pics"]), 
            "post_price"        =>  $_POST["price"],  
            "post_product_link" =>  $_POST["link"], 
            "post_duree"        =>  $_POST["duree"] 
        );
        
        
        $requete = $DB->prepare('UPDATE `post` SET post_type = :post_type, post_title = :post_title, post_desc = :post_desc, post_content = :post_content, post_cover_pics = :post_cover_pics, post_price = :post_price, post_product_link = :post_product_link, post_duree = :post_duree  WHERE post_ID = :post_ID;
        DELETE FROM cat_link WHERE cat_link.post_ID = :post_ID;');
        $requete->execute($values); 
        
        if(isset($_POST["cats"]) && !empty($_POST["cats"]) && !is_null($_POST["cats"])){
            if(is_array($_POST["cats"])){
                foreach($_POST["cats"] as $cat){ 
                    $cats_values = array("cat" => $cat, "post_ID" => $_POST["post_ID"]);
                    $requete = $DB->prepare('INSERT INTO `cat_link` (cat_ID, post_ID) VALUES ( :cat, :post_ID)');
                    $requete->execute($cats_values); 
                }
            }
        }
        
        
        
    } else {
        die("oui");
    }

    header("Location:edit-page.php?state=edit&page-id=".$_POST["post_ID"]);

?>