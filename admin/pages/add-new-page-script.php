<?php 

    require_once(dirname(__FILE__)."/../../config.php");

    if(!empty($_POST)){
        
        $values = array( 
            "post_type"         =>  "formule", 
            "post_title"        =>  $_POST["page-title"], 
            "post_desc"         =>  $_POST["description"], 
            "post_content"      =>  $_POST["content"], 
            "post_cover_pics"   =>  '', 
            "post_price"        =>  $_POST["price"], 
            "post_product_link" =>  $_POST["link"], 
            "post_duree"        =>  $_POST["duree"]
        );
        
        $requete = $DB->prepare('INSERT INTO `post` (post_type, post_title, post_desc, post_content, post_cover_pics, post_price, post_product_link, post_duree) VALUES (:post_type, :post_title, :post_desc, :post_content, :post_cover_pics, :post_price, :post_product_link, :post_duree);');
        $requete->execute($values);
        
        $id = $DB->lastInsertId();
        if(isset($_POST["cats"]) && !empty($_POST["cats"]) && !is_null($_POST["cats"])){
            if(is_array($_POST["cats"])){
                foreach($_POST["cats"] as $cat){ 
                    $cats_values = array("cat" => $cat, "post_ID" => $id);
                    $requete = $DB->prepare('INSERT INTO `cat_link` (cat_ID, post_ID) VALUES ( :cat, :post_ID)');
                    $requete->execute($cats_values); 
                }
            }
        }
        
        
    } else {
        die("oui");
    }

    header("Location:edit-page.php?state=edit&page-id=".$id);

?>