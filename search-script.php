<?php 
$merged_request = '';

if(isset($_GET["action"]) && $_GET["action"] === "search"){
    
    //recherche par mot clé
    if(isset($_GET["keyword"]) && !empty($_GET["keyword"]) && $_GET["keyword"] != ''){

        //déclaration des variables pour ne pas avoir d'erreur undefined variables :
        $keywords = $_GET["keyword"];


        $keywords_tab = explode(" ", $keywords);
        if(!is_array($keywords_tab)){
            $keywords_tab = array($keywords_tab);
        }

        $keyword_request = '';

        foreach($keywords_tab as $word){
            $keyword_request = $keyword_request."post.post_title LIKE '%".$word."%' OR post.post_content LIKE '%".$word."%' OR post.post_desc LIKE '%".$word."%' OR ";
        }

        $keyword_request = substr($keyword_request, 0, strrpos($keyword_request, "OR "));

        $merged_request = $merged_request.$keyword_request;
    } else {
        $keywords = '';
    }
    
    //recherche par nb de jours
    if(isset($_GET["duree"]) && !empty($_GET["duree"]) && $_GET["duree"] != ''){

        //déclaration des variables pour ne pas avoir d'erreur undefined variables :
        $duree = $_GET["duree"];


        $duree_request = "post.post_duree <= ".$duree;

        if(!empty($merged_request)){
            $merged_request = $merged_request." AND ".$duree_request;
        } else {
            $merged_request = $merged_request.$duree_request;
        }
    } else {
        $duree_request = '';
    }
    
    //recherche par type de type (genre activité, thèmes, ...)
    if(isset($_GET["type"]) && !empty($_GET["type"]) && $_GET["type"] != ''){
        
        $types_tab = $_GET["type"];
        $type_request = "cat_link.post_ID = post.post_ID AND cat_link.cat_ID = categories.cat_ID AND (";
        
        foreach($types_tab as $grp){
            $type_request = $type_request."categories.cat_ID = {$grp} OR " ;
        }
        
        $type_request = substr($type_request, 0, strrpos($type_request, "OR "));
        $type_request = $type_request.")";
        
        if(!empty($merged_request)){
            $merged_request = $merged_request." AND ".$type_request;
        } else {
            $merged_request = $merged_request.$type_request;
        }
        

        
    } else {
        $type_request = '';
    }
    
} else {
    $keywords = '';
}

if($merged_request === ''){
    $merged_request = '1';
}


$requete = $DB->query("SELECT post.post_ID, post.post_title, post.post_content, post.post_desc, post.post_cover_pics, post.post_price, post.post_product_link, post.post_duree FROM post, categories, cat_link WHERE ".$merged_request." GROUP BY post.post_ID");
$formules = $requete->fetchAll(PDO::FETCH_OBJ);


?>