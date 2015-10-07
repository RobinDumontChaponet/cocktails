<!--meta title="Favoris"-->

<div id="content">
    <p>
    </p>

    <?php if (!isset($_SESSION['cocktailsUser'])) { ?>
        <p>Note : Si vous n'avez pas de compte, les favoris seront temporairement stockés. Pour remédier à cela, créez un compte <a href="signin">ICI</a> ou <a href="connection">connectez-vous</a></p>
     <?php } ?>
</div>
