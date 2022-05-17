<?php

require 'data.php';     // La liste des pays



// Récupération du paramètre de recherche (query string de la requête HTTP GET).
$query = trim(strtolower($_GET['country']));    // Suppression des espaces, conversion en minuscules

/*
 * Exemple de requête HTTP GET :
 *
 * /api.php?country=Fra 
 *      ==> $_GET['country'] vaudra 'Fra'
 *      ==> $query vaudra 'fra'
 *
 * Va renvoyer comme résultat au moins 'France'
 */


$result = null;

// Est-ce qu'un paramètre de recherche a bien été fourni ?
if(empty($query) == false)
{
    // Oui, recherche de la valeur dans la liste des pays.
    foreach($countries as $country)
    {
        // Recherche de la chaîne de caractères demandée (par exemple 'fra') dans le pays spécifié.
        // Voir https://www.php.net/manual/fr/function.stristr.php
        if(stristr($country, $query) !== false)
        {
            // Cumule les résultats en HTML (le client de l'API devra placer le résultat dans une balise <ul> ou <ol>)
            $result .= "<li>$country</li>";
        }
    }
}

// Est-ce qu'au moins un pays a été trouvé ?
if($result == null)
{
    // Non, message par défaut indiquant l'échec de la recherche.
    $result = '<li>Aucune idée !</li>';
}

// Renvoie la réponse HTTP au format HTML.
echo $result;