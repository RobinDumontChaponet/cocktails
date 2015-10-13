<header>
	<h1><a href="<?= SELF ?>/"><span>Cocktails</span></a></h1>
	<nav id="menu">
		<ul>
			<li class="recipes<?= ($_GET['requ']=='recipes')?' active ':'' ?>"><a href="recipes"><span>Toutes les recettes</span></a></li>
			<li class="favorites<?= ($_GET['requ']=='favorites')?' active ':'' ?>"><a href="favorites">Mes favoris</a></li>

		<?php if(empty($_SESSION['cocktailsUser'])) { ?>
			<li class="login<?= ($_GET['requ']=='login')?' active ':'' ?>"><a href="login"><span>Se connecter</span></a></li>
		<?php } else { ?>
			<li class="user sub<?= ($_GET['requ']=='profile')?' active ':'' ?>"><a href="profile"><?= $_SESSION['cocktailsUser']->getLogin() ?></a>
				<ul>
					<li><a href="profile">Profil</a></li>
					<li><a href="logout">Se déconnecter</a></li>
				</ul>
			</li>
		<?php } ?>
		</ul>
	</nav>
</header>