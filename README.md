# WARNING : Il est préférable de lire cette documentation sur le github du projet (lien ci-dessous)

https://github.com/lolegrand/projet-croissantage/blob/main/README.md

# Web technologie project.

Web technologie project for student purpose.

**Louis Legrand** ENSSAT promotion 2024

# How to start

> git clone https://github.com/lolegrand/projet-croissantage.git
> cd projet-croissantage
> composer install
> composer start

Je suppose que vous avez une base de donné correctement installé et un composer fonctionnel.
Pour vous connecter à la base de donné merci de modifer le fichier ***projet-croissantage/src/settings.php***
en fonction.

# Liste des fonctionalités implémentés

## Page de connection est d'enregistrement

![image](https://user-images.githubusercontent.com/61364945/162048557-3f036d23-9ac2-474d-b80a-03d871e3e498.png)

### Fait :
 - Un systéme de connection utilisant les donnés de la base fourni.
 - Un systéme d'enregistrement qui enregistre un nouvelle étudiant dans la base de donné.
 - Un systéme d'affichage des erreurs si il y a une erreur lors de la connection ou de l'enregistrement.
 - Des contraintes simples dans la vue pour vérifier la saisie de l'utilisateur.

### A faire :
 - Nettoyer la saisie des utilisateurs.

## Page utilisateur

![image](https://user-images.githubusercontent.com/61364945/162048864-4f7cccff-967b-4f44-9e8a-f3f6119b4253.png)


### Fait :
  - Affichage du nom, de l'alias, des roles, de la pâtisserie et de l'historique des promotion d'un étudiant.
  - Modification en base de l'alias et de la patiserie d'un étudiant (les rôles sont modifier dans la page admin).
  - Affichage de la liste des étudiant présent en base (étudiant courrant exclu).

### A faire :
  - Nettoyer la saisie des utilisateurs lors de la modification d'un champs.

## Page administration :

![image](https://user-images.githubusercontent.com/61364945/162051515-fa421ac7-ba21-4722-b786-36e0fd9ddce5.png)

### Fait :
  - Affichage de la liste de pâtisserie actuellement en base.
  - Ajout d'une pâtisserie en base.
  - Affichage de tout les étudiants en base ainsi que leur droit.
  - Possibilité de modifier les droits des utiliseurs.
  - Restriction à la page seulment pour les utilisateurs avec un rôle "admin".
  - Affichage dynamic pour les droits pouvant être ajouté ou non.

### A faire :
  - Nettoyer la saisi d'une pâtisserie.

## Page croissantage (In progress):

![image](https://user-images.githubusercontent.com/61364945/162050349-2a8371d7-8c5c-40a6-a63b-9b46a6aab785.png)

### Fait :
 - Affichage de tout les croissantages.
 - Affichage de toutes les commandes liée à un croissantage.

### A faire :
 - Nettoyer les debugs de la page.
 - Ajouter une option de saisie d'une nouveau croissantage.
 - Ajouter une option de saisie d'une commande.

## Dans le projet globalement :

### Fait :
  - Utilisation du routeur.
  - Création d'un singleton pour stocker et utiliser la connection à la base.
  - Une "header" globale pour accéder à toute l'application.

### A faire :
  - La page de statistique.
  - Du css pour que le projet soit moin root.
  - La gestion du CSRF.
  - Commenter le code.
