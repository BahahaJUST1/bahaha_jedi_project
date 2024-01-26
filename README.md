# THE JEDI PROJECT
\
Ce projet est un projet universitaire réalisé dans le cadre du cours de développement avancé de BUT3.\
THE JEDI PROJECT met en scène différentes entités de l'univers de Star Wars au sein d'un projet Symfony.\
Veuillez noter que le lore n'est pas totalement en adéquation avec les entités de ce projet en raison des exigences du sujet.\
\

## LANCEMENT DU PROJET
\
**Prérequis :**
- Un environnement PHP de version 8 ou plus
- Une base de données MySQL
\
**Téléchargement :**
- `git clone https://github.com/BahahaJUST1/bahaha_jedi_project.git`
\
**Initialisation :**
- Créer un fichier `.env.local` à la racine du projet
- Y remplir ses informations de connexion à la bdd ex : `DATABASE_URL="mysql://id_user:mdp_user@127.0.0.1:3306/jedi_project?serverVersion=8&charset=utf8mb4"`
- Installer composer : `composer i`
- Accéder au site depuis son localhost ex : `http://localhost/bahaha_jedi_project/public/`
\

## FEATURES POUR ADMINS
\
Les administrateurs ont la possibilité d'ajouter d'autres administrateurs et de gérer les entités du projet.\
Il est possible de se connecter en tant qu'administrateur depuis la page d'accueil du projet en cliquant sur le bouton *SITH ONLY*.\
Les identifiants de connexion sont les suivants :
- login    : root@gmail.com
- password : root
\
*Mise en garde : le pouvoir des siths est très puissant et risque de vous détourner du côté lumineux de la force. Prenez garde si vous ne voulez pas finir consumé par la peur et la haine.*
\

## ENTITES ET RELATIONS

### ENTITE PRINCIPALE
\
Ce projet est composé d'une entité principale : **Jedi**.\
Chaque Jedi dispose d'un champ de type enum intitulé *status*. Ce dernier peut-être :\
- Un *chevalier* jedi
- Un *maître* jedi
- Un *grand-maître* jedi
- Un *sith*
\
Voici les relations qui composent un Jedi :
- OneToMany : Un jedi peut avoir plusieurs sabres laser
- OneToOne : Un jedi est lié à un et un seul Padawan
- ManyToOne : Plusieurs jedis peuvent être en charge d'une légion de clones
- ManyToMany : Plusieurs jedis peuvent être impliqués dans plusieurs guerres

### ENTITES ENFANTS
\
Les entités enfants qui sont en lien avec les jedis sont : **Sabre**, **Padawan**, **Legion**, **Guerre**\
\
Voici les relations que ces dernières entretienent avec les jedis:
- OneToMany : Une légion de clones peut être dirigée par plusieurs jedis
- OneToOne: Un padawan n'a qu'un seul maître
- ManyToOne : Plusieurs sabres laser peuvent apartenir à un seul jedi
- ManyToMany : Plusieures guerres peuvent être menées par plusieurs jedis
\
Les entités enfants qui sont en relations avec d'autres entités enfants sont : **Sabre**, **Padawan**
- OneToMany : Un padawan peut avoir plusieurs sabres laser
- ManyToOne : Plusieurs sabres laser peuvent apartenir à un seul padawan
