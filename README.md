# Projet de Web Licence 3 informatique.

## D'après le sujet
"L’application concerne un certain nombre de fonctionnalités détaillées ci-dessous pour accéder à des recettes de cocktails. Les données à exploiter sont celles fournies dans Projet.zip.
L'application est à développer en PHP (avec ou sans base de données) et doit fonctionner sous la version d’EasyPHP installée en salle machine sans modification de l’installation standard."

### Accès hiérarchique aux recettes à partir de la hiérarchie des aliments
"Il doit être possible de naviguer dans la hiérarchie des aliments et de visualiser les recettes utilisant un aliment en tant qu’ingrédient. La navigation consiste à sélectionner des éléments de plus en plus précis (par exemple : fruit -> agrume -> orange). Les recettes présentées seront celles utilisant l’aliment sélectionné (par exemple : recettes avec fruit(s), recettes avec agrume(s), recettes avec orange(s)). Il est également demandé d’afficher le chemin menant à l’aliment courant (depuis la rubrique de plus haut niveau en passant par les rubriques intermédiaires).
L’affichage d’une recette devra être agrémenté de sa photo correspondante, si elle existe."

### Panier (de recettes) ou « Mes recettes préférées »
"A l’instar des sites de commerces électroniques avec panier (de produits), l’utilisateur devra pouvoir sélectionner les recettes qu’il apprécie pour les mettre dans un panier (de recettes !), qui peut être vu comme l’ensemble des recettes préférées de l’utilisateur. Cet ensemble de recettes :
- est initialement vide quand l’utilisateur ne s’est pas encore identifié ;
- augmente quand l’utilisateur sélectionne des recettes (fonctionnalité : « ajouter cette recette à mes recettes préférées »)
- diminue lorsque l’utilisateur supprime une recette de ses recettes préférées (fonctionnalité « supprimer cette recette de mes recettes préférées ») ;
- est complété par les recettes préférées « déjà connues » de l’utilisateur quand celui-ci se connecte. L’ensemble des recettes préférées d’un utilisateur doit être stocké de façon durable si l’utilisateur est identifié (pour qu’il puisse les consulter ultérieurement).
Un lien « Mes recettes préférés » dans l’interface doit permettre à tout utilisateur d’accéder à ses recettes préférées."

### Identification et données utilisateur
"Un utilisateur doit pouvoir se connecter à l’application à n’importe quel moment (pas forcément avant la consultation/sélection des recettes) ; cette connexion n’est pas obligatoire. Si l’utilisateur n’est pas connecté, les recettes sélectionnées ne seront pas stockées durablement. La connexion nécessite la saisie des données personnelles suivantes : login, mot de passe, nom, prénom, sexe (homme ou femme), adresse électronique, date de naissance, adresse postale (décomposée en adresse, code postal et ville) et numéro de téléphone ; seuls le login et le mot de passe sont obligatoires. Une fois les données personnelles saisies, l’utilisateur pourra s’identifier par « login / mot de passe » pour ré-accéder ultérieurement à l’application. Il devra également pouvoir modifier ses données personnelles à tout moment. Le login sera obligatoirement unique."

# @TODO

- [x] verifications (and display errors to user) in forms ;
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

