<?php

namespace Mage2\Framework\Search;

use Goutte\Client;

class SearchManager
{

    public function indexed($uri)
    {

        return $this;

        $url = asset($uri);
        $fileName = str_replace(asset("/"), "", $url) . ".html";

        $fileName = ("" == $fileName) ? "index.html" : $fileName;

        echo storage_path('framework/search/');

        die;

        $client = new Client();
        $crawler = $client->request('GET', $url);

        dd($crawler);

        dd(storage_path('framework/search/') . $fileName);
        file_put_contents(storage_path('framework/search/') . $fileName, $crawler->html());

        dd('here');
        return $this;
        echo "DO PAGE INDEX HERE";
    }

}