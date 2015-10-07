<!--meta title="Recettes"-->

<style>
<?php // C'est juste parce que je me paume que je fais ce style ...?>
#content h3 {
    font-weight: bold;
}
#content li {
    border-style: solid;
    border-width: 1px;
    padding: 5px;
}
</style>
<div id="content">
    <ul>
        <?php foreach($recipes as $recipe) {
            echo '<li>';
            echo '<h3>'.$recipe->getTitle().'</h3>'; // Titre
            echo '<p> Ingrédients : '.$recipe->getQuantities().'</p>';
            echo '<p> Préparation : '.$recipe->getInstructions().'</p>'; ?>
            <p>Index : </p>
                <ul>
                <?php foreach ($recipe->getIngredients() as $index) {
                    echo '<li><a href="#">'.$index.'</a></li>';
                } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</div>