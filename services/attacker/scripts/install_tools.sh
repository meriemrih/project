#!/bin/bash

# Mettre à jour le système
echo "[+] Mise à jour du système..."
apt update && apt upgrade -y

# Installer les outils de base
echo "[+] Installation des outils de base..."
apt install -y net-tools iputils-ping curl wget nano unzip git

# Installer les outils de reconnaissance et scan
echo "[+] Installation des outils de reconnaissance et scan..."
apt install -y nmap traceroute dnsutils whois

# Installer les outils d'attaque réseau
echo "[+] Installation des outils d'attaque réseau..."
apt install -y hydra john sqlmap gobuster wfuzz hping3 nikto

# Installer les outils de sniffing et MITM
echo "[+] Installation des outils de sniffing et MITM..."
apt install -y wireshark tcpdump

# Installer les outils d’exploitation
echo "[+] Installation des outils d’exploitation..."
apt install -y metasploit-framework exploitdb

# Mettre à jour les bases de données des outils
echo "[+] Mise à jour des bases de données..."
msfupdate  # Pour Metasploit
searchsploit -u  # Mettre à jour exploitdb

# Afficher un message de fin
echo "[+] Installation terminée ! Tous les outils sont prêts à l'emploi."

