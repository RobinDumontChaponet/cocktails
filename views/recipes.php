<!--meta title="Recettes"-->

<style>
<?php // C'est juste parce que je me paume que je fais ce style ...?>
h3 {
    font-weight: bold;
}
li {
    border-style: solid;
    border-width: 1px;
    padding: 5px;
}
</style>
<div id="content">
    <ul>
        <?php foreach($Recettes as $recipe) {
            echo '<li>';
            echo '<h3>'.array_values($recipe)[0].'</h3>'; // Titre
            echo '<p> Ingrédients : '.array_values($recipe)[1].'</p>';
            echo '<p> Préparation : '.array_values($recipe)[2].'</p>'; ?>
            <p>Index : </p>
                <ul>
                <?php foreach (array_values($recipe)[3] as $index) {
                    echo '<li><a href="#">'.$index.'</a></li>';
                } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</div>
