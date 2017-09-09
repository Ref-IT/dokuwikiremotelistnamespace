# dokuwikiremotelistnamespace

Example usage:

    $depth = 1;
    $wikiUrl = "https://wiki.example.org";
    $wikiClient = XML_RPC2_Client::create($wikiUrl."/lib/exe/xmlrpc.php");
    $method="plugin.remotelistnamespace.listNamespace";
    $result = $wikiClient->$method($wiki, [ "depth" => $depth ]);
