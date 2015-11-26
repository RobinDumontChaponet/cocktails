<?php
$requestUrl = $transit->getRequestUrl();
?>
<header>
	<h1><a href="<?php echo SELF ?>/"><span>Cocktails</span></a></h1>
	<nav id="menu">
		<ul>
			<li class="recipes<?php echo ($requestUrl=='all')?' active ':'' ?>"><a href="all"><span>Les recettes</span></a></li>
			<li class="favorites<?php echo ($requestUrl=='favorites')?' active ':'' ?>"><a href="favorites">Mes favoris</a></li>

		<?php if(empty($_SESSION['cocktailsUser'])) { ?>
			<li class="user<?php echo ($requestUrl=='login')?' active ':'' ?>"><a href="login"><span>Se connecter</span></a></li>
		<?php } else { ?>
			<li class="user sub<?php echo ($requestUrl=='profile')?' active ':'' ?>"><a href="profile"><?php echo $_SESSION['cocktailsUser']->getLogin() ?></a>
				<ul>
					<li><a href="profile">Profil</a></li>
					<li><a href="logout">Se déconnecter</a></li>
				</ul>
			</li>
		<?php } ?>
		</ul>
	</nav>
</header>