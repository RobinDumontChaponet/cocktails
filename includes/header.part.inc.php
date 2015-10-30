<?php
$requestUrl = $transit->getRequestUrl();
?>
<header>
	<h1><a href="<?= SELF ?>/"><span>Cocktails</span></a></h1>
	<nav id="menu">
		<ul>
			<li class="recipes<?= ($requestUrl=='recipes')?' active ':'' ?>"><a href="recipes"><span>Toutes les recettes</span></a></li>
			<li class="favorites<?= ($requestUrl=='favorites')?' active ':'' ?>"><a href="favorites">Mes favoris</a></li>

		<?php if(empty($_SESSION['cocktailsUser'])) { ?>
			<li class="login<?= ($requestUrl=='login')?' active ':'' ?>"><a href="login"><span>Se connecter</span></a></li>
		<?php } else { ?>
			<li class="user sub<?= ($requestUrl=='profile')?' active ':'' ?>"><a href="profile"><?= $_SESSION['cocktailsUser']->getLogin() ?></a>
				<ul>
					<li><a href="profile">Profil</a></li>
					<li><a href="logout">Se déconnecter</a></li>
				</ul>
			</li>
		<?php } ?>
		</ul>
	</nav>
</header>