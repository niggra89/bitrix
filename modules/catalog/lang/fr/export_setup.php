<?
$MESS ['CES_ERROR_NO_FILE'] = "Le dossier d'exportation n'est pas mis.";
$MESS ['CES_ERROR_NO_ACTION'] = "L'action n'est pas mise.";
$MESS ['CES_ERROR_FILE_NOT_EXIST'] = "Le dossier d'exportation n'est pas trouvé:";
$MESS ['CES_ERROR_NOT_AGENT'] = "Ce profil ne peut pas être utilisé pour les agents parce qu'il est utilisé par défaut et un dossier de cadres est défini pour l'exportateur actuel.";
$MESS ['CES_ERROR_ADD_PROFILE'] = "Erreur ajoutant le profil.";
$MESS ['CES_ERROR_NOT_CRON'] = "Ce profil ne peut pas être utilisé avec cron parce qu'il est utilisé par défaut et un dossier de cadres est défini pour l'exportateur actuel.";
$MESS ['CES_ERROR_ADD2CRON'] = "erreur d'installation le dossier de configuration avec cron :";
$MESS ['CES_ERROR_UNKNOWN'] = "erreur inconnue.";
$MESS ['CES_ERROR_NO_PROFILE1'] = "Profil #";
$MESS ['CES_ERROR_NO_PROFILE2'] = "n'est pas trouvé.";
$MESS ['CES_ERROR_SAVE_PROFILE'] = "Erreur sauvegardant le profil d'exportation.";
$MESS ['CES_ERROR_NO_SETUP_FILE'] = "Le dossier d'organisation d'exportation n'est pas trouvé.";
$MESS ['TITLE_EXPORT_PAGE'] = "Organisation d'exportation";
$MESS ['CES_ERRORS'] = "erreur en exécutant l'opération :";
$MESS ['CES_SUCCESS'] = "L'opération accomplie avec succès.";
$MESS ['CES_EXPORT_FILE'] = "Fichier de données d'exportation :";
$MESS ['CES_EXPORTER'] = "Exporter";
$MESS ['CES_ACTIONS'] = "Actions";
$MESS ['CES_PROFILE'] = "Profil";
$MESS ['CES_IN_MENU'] = "Dans le menu";
$MESS ['CES_IN_AGENT'] = "Dans les agents";
$MESS ['CES_IN_CRON'] = "Sur cron";
$MESS ['CES_USED'] = "Dernière course";
$MESS ['CES_ADD_PROFILE_DESCR'] = "Ajoutez le nouveau profil d'exportation";
$MESS ['CES_ADD_PROFILE'] = "Ajoutez le profil";
$MESS ['CES_DEFAULT'] = "Défaut";
$MESS ['CES_NO'] = "Non";
$MESS ['CES_YES'] = "Oui";
$MESS ['CES_RUN_INTERVAL'] = "La période entre les lancements (les heures):";
$MESS ['CES_SET'] = "Installer";
$MESS ['CES_DELETE'] = "Effacer";
$MESS ['CES_CLOSE'] = "Près";
$MESS ['CES_OR'] = "ou";
$MESS ['CES_RUN_TIME'] = "Temps de lancement :";
$MESS ['CES_PHP_PATH'] = "Sentier à php :";
$MESS ['CES_AUTO_CRON'] = "installer automatiquement :";
$MESS ['CES_AUTO_CRON_DEL'] = "Effacez automatiquement :";
$MESS ['CES_RUN_EXPORT_DESCR'] = "Commencez l'exportation de données";
$MESS ['CES_RUN_EXPORT'] = "Exportation";
$MESS ['CES_TO_LEFT_MENU_DESCR'] = "Ajoutez le lien de menu dans le menu gauche";
$MESS ['CES_TO_LEFT_MENU_DESCR_DEL'] = "Effacez le lien de menu du menu gauche";
$MESS ['CES_TO_LEFT_MENU'] = "Ajoutez au menu";
$MESS ['CES_TO_LEFT_MENU_DEL'] = "Effacez du menu";
$MESS ['CES_TO_AGENT_DESCR'] = "Créez un agent pour le lancement automatisé";
$MESS ['CES_TO_AGENT_DESCR_DEL'] = "Effacez du réactif pour le lancement automatisé";
$MESS ['CES_TO_AGENT'] = "Créez un agent";
$MESS ['CES_TO_AGENT_DEL'] = "Effacez du réactif";
$MESS ['CES_TO_CRON_DESCR'] = "Utilisez cron du lancement automatisé";
$MESS ['CES_TO_CRON_DESCR_DEL'] = "Déménagez de cron";
$MESS ['CES_TO_CRON'] = "Utilisez cron";
$MESS ['CES_TO_CRON_DEL'] = "Arrêtez cron";
$MESS ['CES_SHOW_VARS_LIST_DESCR'] = "Les variables énumérées pour ce profil d'exportation";
$MESS ['CES_SHOW_VARS_LIST'] = "Liste de variables";
$MESS ['CES_DELETE_PROFILE_DESCR'] = "Effacez ce profil";
$MESS ['CES_DELETE_PROFILE_CONF'] = "Êtes-vous sûrs que vous voulez effacer ce profil ?";
$MESS ['CES_DELETE_PROFILE'] = "Effacez le profil";
$MESS ['CES_NOTES1'] = "Les agents sont des fonctions de PHP qui sont dirigées périodiquement à un intervalle donné.  chaque fois une page est demandée, le système vérifie automatiquement pour les agents qui ont besoin d'être exécutés et les dirigent. On ne recommandant pas d'assigner d'assez longs ou grands travaux d'exportation aux agents. Vous devriez utiliser le démon cron de ce but.";
$MESS ['CES_NOTES2'] = "Le démon cron est disponible seulement sur les serveurs UNIX-fondés.";
$MESS ['CES_NOTES3'] = "Le démon cron travaille à l'arrière-plan le mode et les courses les tâches assignées au temps spécifié. Vous avez besoin de spécifier le dossier de configuration pour ajouter une opération d'exportation à la liste de tâche";
$MESS ['CES_NOTES4'] = "dans cron. Ce dossier contient des instructions pour les opérations d'exportation. Après que vous avez changé le jeu de tâches cron, vous devez installer le dossier de configuration de nouveau.";
$MESS ['CES_NOTES5'] = "Pour mettre le dossier de configuration vous devez communiquer à votre site via le SSH ou SSH2 ou autre protocole semblable que votre pourvoyeur soutient pour la coquille des opérations lointaines. Dans la ligne de commande, dirigée l'ordre";
$MESS ['CES_NOTES6'] = "Pour voir la liste de tâches actuellement installées, dirigez l'ordre";
$MESS ['CES_NOTES7'] = "Pour enlever toutes les tâches assignées au cron, dirigez l'ordre";
$MESS ['CES_NOTES8'] = "Liste actuelle des tâches cron :";
$MESS ['CES_NOTES10'] = "Attention! Cela enlèvera aussi n'importe quelles tâches pas dans le dossier de configuration.";
$MESS ['CES_NOTES11'] = "Le dossier qui lance le script d'exportation pour diriger les tâches avec cron est";
$MESS ['CES_NOTES12'] = "Garantissez s'il vous plaît que ce dossier contient des sentiers corrects à la racine de site et au PHP";
?>