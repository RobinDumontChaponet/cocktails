# @TODO

- [ ] verifications (and display errors to user) in forms ;
- [x] CREATE DATABASE...
- [x] beautification of everything :—) ;
- [x] code cleaning ;
- [x] install.php ;
- [?] last (crash)tests ;
- PENSER À REMPLACER "includes/conf.inc.php" par "config.beforeinstall.inc.php" à renommer en "conf.inc.php" !
- [x] display cocktails hierarchy ;
- [x] redirect to last page when successfully logged-in ;
- [x] DAO wrapper and class(es) for "$Hierarchie" ;
- [x] complete favorites ui/ux ;
- [x] make profile page more like sign-in page (maybe ?) ;
- that's it ?!

---


# cocktails

-> Projet PHP L3 <-



*3 Parties :*
Un accès à des recettes et des fruits
Une panier de recettes ou "Mes recettes préférées" ... un favoris quoi ...
Une histoire d'utilisateur et de données stockés



## controllers /
- connection.php --> Page used to connect
- home.php          --> Home page
- account.php      --> Manage account
- registration.php --> Register an account
- favorites.php     --> Allows user to see their "favorites"
- cocktails[/?categorie/sub/aliment]



## views /
- connection.php --> Page used to connect
- home.php          --> Home page
- account.php      --> Manage account
- registration.php --> Register an account
- favorites.php     --> Allows user to see their "favorites"
- cocktails[/?categorie/sub/aliment]

## data /
- Photos/
  Ex : Black\_velvet.jpg, Bloody\_mary.jpg

## models /
- User
- Cocktail

## includes /
- Donnees.inc.php
- passwordhash.inc.php




*En gros* : T'as une catégorie en haut -> plus bas -> plus bas
Genre : Fruit -> Fruit à Noyau -> Pêche
(Fruit à noyau est une sous-catégorie de Fruit)
Et depuis pêche, dans le fichier, t'as "super-catégorie" qui représente le niveau au dessus : Fruit à Noyau
Ca permet d'avoir la hiérarchie.
