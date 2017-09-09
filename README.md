# dokuwikiremotelistnamespace

Example usage:

    $depth = 1;
    $wikiClient = XML_RPC2_Client::create($wikiUrl."/lib/exe/xmlrpc.php", Array("httpRequest" => $request, "backend" => "php"));
    $method="plugin.remotelistnamespace.listNamespace";
    $result = $wikiClient->$method($wiki, [ "depth" => $depth ]);
