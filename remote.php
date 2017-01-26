<?php
class remote_plugin_remotelistnamespace extends DokuWiki_Remote_Plugin {
  public function _getMethods() {
    return array(
      'listNamespace' => array(
        'args' => array('string', 'array'),
        'return' => 'array',
        'doc' => 'List all namespaces within the given namespace.',
        'name' => 'listNamespace'
      )
    );
  }

  /**
   * List all namespaces in the given namespace (and below)
   *
   * @param string $ns
   * @param array  $opts
   *    $opts['depth']   recursion level, 0 for all
   * @return array
   */
  public function listNamespace($ns,$opts){
    global $conf;

    if(!is_array($opts)) $opts=array();

    $ns = cleanID($ns);
    $dir = utf8_encodeFN(str_replace(':', '/', $ns));
    $data = array();
    search($data, $conf['datadir'], Array($this, 'search_namespace'), $opts, $dir);
    return $data;
  }

  /**
   * Just lists all namespaces
   *
   * $opts['depth']   recursion level, 0 for all
   *
   * @author  Michael Braun <michael-dev@fami-braun.de>
   */
  function search_namespace(&$data,$base,$file,$type,$lvl,$opts){
    //we do nothing with files
    if($type != 'd'){
      return false;
    }

    if(isset($opts['depth']) && $opts['depth']){
      $parts = explode('/',ltrim($file,'/'));
      if(count($parts) > $opts['depth'])
        return false; // depth reached
    }

    $item = array();
    $item['id']   = pathID($file);
    if(auth_quickaclcheck($item['id']) < AUTH_READ){
      return false;
    }

    $data[] = $item;

    if(isset($opts['depth']) && $opts['depth']){
      $parts = explode('/',ltrim($file,'/'));
      if(count($parts) >= $opts['depth'])
        return false; // depth reached, no recursion required
    }
    return true;
  }

}

