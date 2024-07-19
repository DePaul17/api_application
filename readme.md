# API de Gestion des Factures

Cette application expose une API pour la gestion des clients, des produits, des taux de taxe, des factures et des éléments de facture.

## Lancement de l'application
Pour lancer l'application il faut accéder au dossier public du projet et taper la commande : php -S localhost:$PORT(dans mon cas 8889).

## Requetes base de donnée
Le code responsable de la gestion de la base de donnée et des intéractions avec cette dernière se trouve dans le dossier src.

## Gestion des requêtes
Le code en charge des requêtes HTTP et de la logique applicative associée aux opérations se trouve dans le dossier controllers.

## Gestion de la base de donnée
Un fichier factures_okayo_db.sql se trouve dans le dossier config.

## Installation

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/api_gestion_factures.git
