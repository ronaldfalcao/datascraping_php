<?php
/**
 * Created by PhpStorm.
 * User: Ronald B. Falcão
 * Date: 25/07/2015
 * Time: 16:42
 */

    header ('Content-type: text/html; charset=UTF-8');

    //Adquirindo as informações da página, todos os elementos que aparecerem nela...
    $fontePuraDados = file_get_contents("https://pt.wikipedia.org/wiki/Lista_das_maiores_empresas_do_Brasil_por_faturamento");

    //Transformando em objetos...
    $dadosHTML = new DOMDocument();
    libxml_use_internal_errors(TRUE);
    $dadosHTML->loadHTML($fontePuraDados);

    //Criando um DOMXPath...
    $documento = new DOMXPath($dadosHTML);

    //Buscando o elemento tabela. Nesse caso vamos achar duas, item (0) e item (1)
    $busca = $documento->query("//table");

    //Sabendo que queremos apenas a item(1), que contém os dados, vamos fazer uma lista...
    $resultado = str_replace(']',']<br/>',$busca->item(1)->nodeValue);

    //Retirando as chaves no formato [Número]...
    $resultado = preg_replace('[\[.+]',"<br/>",$resultado);

    //Exibindo a lista!
    echo $resultado;
