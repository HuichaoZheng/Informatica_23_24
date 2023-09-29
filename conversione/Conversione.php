<?php
// Includi l'autoloader generato da Composer per caricare le classi automaticamente
require 'vendor/autoload.php';

// Usa la classe Yaml dal componente Symfony\Component\Yaml
//È responsabile della conversione tra YAML e strutture dati PHP, come array.
//Documentazione: https://symfony.com/doc/current/components/yaml.html#parsing-php-constants
use Symfony\Component\Yaml\Yaml;

// Percorso del file YAML
$yamlFilePath = 'input.yaml';

// Leggi il contenuto del file YAML
$yamlContent = file_get_contents($yamlFilePath);

// Converte il contenuto YAML in un array PHP
$phpArray = Yaml::parse($yamlContent);

// Converte l'array PHP in JSON formattato per la visualizzazione
/*
    json_encode è una funzione built-in di PHP
    Questa funzione è utilizzata per convertire una variabile PHP in una stringa JSON
    JSON_PRETTY_PRINT: Una costante opzionale che viene passata come secondo argomento per formattare l'output JSON in modo leggibile. 
    Questo rende più facile la visualizzazione del JSON quando si stampa a schermo o si salva in un file.
*/
$jsonOutput = json_encode($phpArray, JSON_PRETTY_PRINT);

// Salva il JSON in un file chiamato output.json
file_put_contents('output.json', $jsonOutput);

// Stampa un messaggio per indicare che la conversione è completata
echo 'Conversione completata.';
