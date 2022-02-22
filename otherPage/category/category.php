<?php 
    $type="category";
    include('../../request/request.php');
    $tag_to_kill = array("<h1>", "</h1>", "<h2>", "</h2>", "<h3>", "</h3>", "<article>");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        if ($show_canonical) {
            echo $canonical_url;
        }
     ?>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo $server_url; ?>src/styles/stylesheets/styles.css" />
    <title><?php echo $result_category['name'];?></title>
    <meta name="description" content="<?php echo $result_category['description'];?>" />
</head>
<body>
    <header>
    <?php 
            include('../../component/navbar.php');
        ?>
        <img class="header-BG" src="<?php echo $server_url;?>assets/header.png" alt="tout savoir sur le SEO"/>
        <?php echo $fil_arianne;?>
        <h1>
            <?php 
                echo $result_category['name'];
            ?>
        </h1>
    </header>
    <main class="category">
        <?php
            while ($show_article = $req_article_from_category->fetch()){
                ?>
                <article>
                    <h2>
                        <a href="<?php 
                                        echo $server_url;
                                        if (isset($parent_category_for_link_article)) echo $parent_category_for_link_article."/";
                                        echo cleanCategoryName($show_article['categoryCurrent'])."/".$show_article['rewriting_url']; 
                                 ?>
                        ">
                            <?php 
                            echo $show_article['title']; 
                            ?>
                        </a>
                    </h2>
                    <img src="<?php echo $server_url."assets/".$show_article['image_url']; ?>" alt="<?php echo $show_article['image_alt']; ?>" />
                    <section>
                        <?php 
                            echo substr(str_replace($tag_to_kill, "", $show_article['content']), 0, 300); 
                        ?>
                        ...
                    </section>
                </article>
                <?php
            }
        ?>
    </main>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>