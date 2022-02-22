  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      
        <ul class="links">
          <li><a href="<?php echo $server_url;?>">Accueil</a></li>
          <li><a href="<?php echo $server_url;?>Technique" class="desktop-link">Technique</a>
            <input type="checkbox" id="show-technique">
            <label for="show-technique">Technique</label>
            <ul>
                <li><a href="<?php echo $server_url;?>Technique/Robots_txt">Robots_txt</a></li>
                <li><a href="<?php echo $server_url;?>Technique/Framework">Framework</a></li>
                <li><a href="<?php echo $server_url;?>Technique/Images">Images</a></li>
                <li><a href="<?php echo $server_url;?>Technique/Balises">Balises</a></li>
            </ul>
          </li>
          <li><a href="<?php echo $server_url;?>Outils" class="desktop-link">Outils</a>
            <input type="checkbox" id="show-outils">
            <label for="show-outils">Outils</label>
            <ul>
                <li><a href="<?php echo $server_url;?>Outils/Google">Google</a></li>
                <li><a href="<?php echo $server_url;?>Outils/Validateur">Validateur</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo $server_url;?>Astuces" class="desktop-link">Astuces</a>
            <input type="checkbox" id="show-astuces">
            <label for="show-astuces">Astuces</label>
            <ul>
            <li><a href="<?php echo $server_url;?>Astuces/Erreur_SEO">Erreur SEO</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo $server_url;?>Dossier" class="desktop-link">Dossier</a>
            <input type="checkbox" id="show-dossier">
            <label for="show-dossier">Dossier</label>
            <ul>
                <li><a href="<?php echo $server_url;?>Dossier/Redaction_SEO">Rédaction SEO</a></li>
                <li><a href="<?php echo $server_url;?>Dossier/Indexation_Google">Indexation Google</a></li>
                <li><a href="<?php echo $server_url;?>Dossier/Tendances">Tendances</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>