@echo off
REM ========================================
REM  Donation Platform - Quick Start
REM ========================================
REM  Auteurs: Younes BACHOUCHE & Berrache HAITHEM
REM  Encadré par: Madame KRIM
REM  Année: 2025/2026
REM ========================================

echo.
echo ╔════════════════════════════════════════════════════╗
echo ║   PLATEFORME DE DONATION - DÉMARRAGE RAPIDE       ║
echo ║   API Testing avec Postman                        ║
echo ╚════════════════════════════════════════════════════╝
echo.

REM Changer le répertoire
cd /d "C:\laragon\www\projetdonationv2"

echo [1/4] Préparation de l'environnement...
echo ✓ Répertoire: %cd%
echo.

echo [2/4] Vérification de PHP et Laravel...
php -v >nul 2>&1
if %errorlevel% neq 0 (
    echo ✗ ERREUR: PHP n'est pas installé ou non accessible
    echo   Assurez-vous que Laragon est bien démarré
    pause
    exit /b 1
)
echo ✓ PHP trouvé
echo.

echo [3/4] Démarrage du serveur Laravel...
echo ✓ Le serveur démarre sur: http://localhost:8000
echo.
echo   ╔══════════════════════════════════════════════════╗
echo   ║  PROCHAINES ÉTAPES:                             ║
echo   ║                                                  ║
echo   ║  1. Attendez que le serveur soit démarré        ║
echo   ║  2. Ouvrez Postman                              ║
echo   ║  3. Importez: Donation_API_Postman_Collection.json
echo   ║  4. Testez les APIs!                            ║
echo   ║                                                  ║
echo   ║  📚 Guide complet: API_GUIDE_POSTMAN.md         ║
echo   ║  📋 Résumé API: API_SUMMARY.md                  ║
echo   ║                                                  ║
echo   ║  Pour arrêter le serveur: Ctrl+C               ║
echo   ╚══════════════════════════════════════════════════╝
echo.

php artisan serve

pause
