<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DiDom\Document;

class ScrapeController extends Controller
{
    public function scrapeExample()
    {
        $url = 'https://www.21vek.by/notebooks/';
        $document = new Document($url, true);

        $elements = $document->find('h1');

        dd($elements);

//        foreach ($elements as $element) {
//            echo $element->text();
//        }
    }
}
