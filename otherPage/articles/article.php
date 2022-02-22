<?php 
    $type="article";
    include('../../request/request.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo $result['subtitle'];?>">
    <link rel="stylesheet" href="<?php echo $server_url; ?>src/styles/stylesheets/styles.css">
    <title><?php echo $result['title'] ?></title>
    <?php echo $json_ld; ?>
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
                echo $result['title'];
            ?>
        </h1>
    </header>
    <main class="article">
        <article>
            <?php echo $result['content']; ?>
        </article>

        <aside class="containeur">
            <?php 
                while ($show_article = $article_linking_network->fetch()){
            ?>
            <aside class="aside">
                <a href="<?php echo $server_url.idToName($show_article['categoryParent'])."/".cleanCategoryName($show_article['categoryCurrent'])."/".$show_article['rewriting_url'];?>" class="aside_link"><?php echo $show_article['title'];?></a>
                <img src="<?php echo $server_url."assets/".$show_article['image_url'];?>" alt="<?php echo $show_article['image_alt'];?>" class="aside_img">
            </aside>
            <?php
                }
            ?>
        </aside>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>