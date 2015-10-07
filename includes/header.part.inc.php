<header>
	<h1><a href="<?= SELF ?>/"><span>Cocktails</span></a></h1>
	<nav>
		<ul>
			<li><a href="recipes" ><span>Toutes les recettes</span></a>
				<ul>
					<li><a href="favorites">Mes favoris</a></li>
				</ul>
			</li>

			<?php if(empty($_SESSION['cocktailsUser'])) { ?>
			<li><a href="connection"><span>Se connecter</span></a></li>
			<?php } else { ?>
			<li><a href="profile"><?= $_SESSION['cocktailsUser']->getLogin() ?></a>
				<ul>
					<li><a href="logout">Se déconnecter</a></li>
				</ul>
			</li>
			<?php } ?>
		</ul>
	</nav>
</header>
