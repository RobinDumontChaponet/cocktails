# cocktails

-> Projet PHP L3 <-



*3 Parties :*
Un accès à des recettes et des fruits
Une panier de recettes ou "Mes recettes préférées" ... un favoris quoi ...
Une histoire d'utilisateur et de données stockés



## controllers /
connection.php --> Page used to connect
home.php          --> Home page
account.php      --> Manage account
registration.php --> Register an account
favorites.php     --> Allows user to see their "favorites"
cocktails[/?categorie/sub/aliment]



## views /
connection.php --> Page used to connect
home.php          --> Home page
account.php      --> Manage account
registration.php --> Register an account
favorites.php     --> Allows user to see their "favorites"
cocktails[/?categorie/sub/aliment]

## data /
Photos/
Ex : Black_velvet.jpg, Bloody_mary.jpg

## models /
User
Cocktail

## includes /
Donnees.inc.php
passwordhash.inc.php




*En gros* : T'as une catégorie en haut -> plus bas -> plus bas
Genre : Fruit -> Fruit à Noyau -> Pêche
(Fruit à noyau est une sous-categorie de Fruit)
Et depuis pêche, dans le fichier, t'as "super-categorie" qui représente le niveau au dessus : Fruit à Noyau
Ca permet d'avoir la hierarchie.
