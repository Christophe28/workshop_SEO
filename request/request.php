<?php
$server_url = "https://www.saralaloux.be/";
$show_canonical = false;

try{
    $bdd = new PDO('mysql:host=saralaloux.be.mysql; dbname=saralaloux_beseo_workshop', 'saralaloux_beseo_workshop', 'seo_workshop');
}
catch(Exception $e){
    die('Erreur :'.$e->getMessage());
}

function cleanCategoryName($category_name) {
  $category_name = str_replace(" ", "_", $category_name);
  $category_name = str_replace("é", "e", $category_name);
  $category_name = str_replace(".", "_", $category_name);
  return $category_name;
}

function idToName($category_id) {
    if($category_id == 1) return "Redaction_SEO";
    if($category_id == 2) return "Technique";
    if($category_id == 3) return "Outils";
    if($category_id == 4) return "Google";
    if($category_id == 5) return "Validateur";
    if($category_id == 6) return "Astuces";
    if($category_id == 7) return "Erreur_SEO";
    if($category_id == 8) return "Dossier";
    if($category_id == 9) return "Indexation_Google";
    if($category_id == 10) return "Robots_txt";
    if($category_id == 11) return "Framework";
    if($category_id == 12) return "Tendances";
    if($category_id == 13) return "Images";
    if($category_id == 14) return "Balises";    
}

$_ENV['id'] = 13;

if(isset($_GET['id']) && intval($_GET['id'])) {
    $_ENV['id'] = $_GET['id'];
}

if ($type=="category") {
    $fil_arianne="<ul class='ariane'><li><a href='".$server_url."'>Homepage</a></li>";
    $req = $bdd -> query("SELECT id, name, description, content, parent_id 
                          FROM category 
                          WHERE id=" .$_ENV['id']);  
    $result_category = $req -> fetch();

    $article_from_category="(a.category_id=".$result_category['id'];

    if ($result_category['parent_id']==0) {
        $fil_arianne.="<li><a href='".$server_url.$result_category['name']."'>".$result_category['name']."</a></li>";
        $parent_category_for_link_article=$result_category['name'];
        $req = $bdd -> query("SELECT id
                          FROM category 
                          WHERE parent_id=" .$result_category['id']); 
        while ($result_child_category = $req->fetch()){
            $article_from_category = $article_from_category . " OR a.category_id=".$result_child_category['id'];
        }
    }

    if ($result_category['parent_id']!=0) {
        $req = $bdd -> query("SELECT name 
                              FROM category 
                              WHERE id=" .$result_category['parent_id']);  
        $fil_arianne_parent_response = $req -> fetch();

        $category_name=cleanCategoryName($result_category['name']);
        $parent_category_for_link_article=$fil_arianne_parent_response['name'];

        $fil_arianne.="<li><a href='".$server_url.$fil_arianne_parent_response['name']."'>".$fil_arianne_parent_response['name']."</a></li>";

        $fil_arianne.="<li><a href='".$server_url.$fil_arianne_parent_response['name']."/".$category_name."'>".$result_category['name']."</a></li>";

        $show_canonical=true;
        $canonical_url="<link rel='canonical' href='".$server_url.$fil_arianne_parent_response['name']."' />";
    }

    $article_from_category.=") AND c.id=a.category_id";
    $req_article_from_category = $bdd -> query("SELECT a.id, a.title, a.subtitle, a.content, a.image_url, a.image_alt, a.rewriting_url, c.name AS categoryCurrent
                          FROM article a, category c
                          WHERE " .$article_from_category. "
                          ORDER BY id desc
                          LIMIT 10");
    $fil_arianne .= "</ul>";
}

if ($type=="article") {
    $carac_to_kill = array(" ", "’", "'", ",", ".", ":", ";");
    $fil_arianne="<ul class='ariane'><li><a href='".$server_url."'>Homepage</a></li>";
    $req = $bdd -> query("SELECT id, title, subtitle, category_id, content, image_url, image_alt, rewriting_url, json_ld 
                          FROM article 
                          WHERE id=" .$_ENV['id']);
    $result = $req -> fetch();
    $json_ld=$result['json_ld'];

    $req = $bdd -> query("SELECT name, parent_id 
                          FROM category 
                          WHERE id=" .$result['category_id']);  
    $result_category = $req -> fetch();

    $category_name_fil_ariane=cleanCategoryName($result_category['name']);

    $req = $bdd -> query("SELECT name 
                          FROM category 
                          WHERE id=" .$result_category['parent_id']);  
    $fil_arianne_parent_response = $req -> fetch();

    $fil_arianne.="<li><a href='".$server_url.$fil_arianne_parent_response['name']."'>".$fil_arianne_parent_response['name']."</a></li>";
    $fil_arianne.="<li><a href='".$server_url.$fil_arianne_parent_response['name']."/".$category_name_fil_ariane."'>".$result_category['name']."</a></li>";
    $fil_arianne.="<li><a href='".$server_url.$fil_arianne_parent_response['name']."/".$category_name_fil_ariane."/".$result['rewriting_url']."'>".$result['title']."</a></li>";
    $fil_arianne.="</ul>";

    $liste_id = $bdd->query('SELECT id FROM article')->fetchAll();
    $id_aleatoire_1 = $liste_id[array_rand($liste_id, 1)]['id'];
    while($id_aleatoire_2 == $id_aleatoire_1 || $id_aleatoire_2 == null){
        $id_aleatoire_2 = $liste_id[array_rand($liste_id, 1)]['id'];
    }
    while($id_aleatoire_3 == $id_aleatoire_2 || $id_aleatoire_2 == $id_aleatoire_1 || $id_aleatoire_3 == null){
        $id_aleatoire_3 = $liste_id[array_rand($liste_id, 1)]['id'];
    }
    $article_linking_network = $bdd->query("SELECT a.id, a.title, a.subtitle, a.content, a.image_url, a.image_alt, a.rewriting_url, c.name AS categoryCurrent, c.parent_id AS categoryParent
                                            FROM article a, category c
                                            WHERE (a.id = '$id_aleatoire_1' OR a.id='$id_aleatoire_2' OR a.id='$id_aleatoire_3') AND a.category_id=c.id");
    
}


if ($type=="index") {
    $req = $bdd -> query("SELECT content 
                          FROM article 
                          WHERE id=" .$_ENV['id']);
    $result = $req -> fetch();
}