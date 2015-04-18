<?php
namespace IO\Api\Search\Engines;

class Jquery {
  
  protected $online    = true;
  protected $uri       = 'http://jquery.com/';
  protected $api       = 'http://api.jquery.com/';
  
  public function isOnline() {
    return $this->online;
  }
  
  public function query($query) {
    
    // Si la page de la doc n'existe pas on renvoi vers la liste des résultats
    $item = [
      'title' => 'Visiter cette page sur '.$this->uri,
      'uri'   => urlencode($this->api.'?s=').$query,
      'alt'   => 'Résultats pour « '.str_replace('+',' ',$query).' » sur jquery.com'
    ];
    
    if($url = $this->pageExists($query)) {
      
      // Si une page existe pour le terme recherché on renvoi directement dessus
      $item = [
        'title' => 'Visiter cette page sur '.$this->uri,
        'uri'   => urlencode($url),
        'alt'   => 'Voir « '.str_replace('+',' ',$query).' » sur jquery.com '
      ];
      
    }
    
    return $item;
  }
   
  private function pageExists($query) {
    
    // Préparation de la requête (supression du . de la méthode et remplacement des + par des espaces)
    $query = str_replace(['.','+'],['',' '],$query);
    
    // Définition de l'url finale
    $url = $this->api.$query.'/';
    
    // Requête
    $ch = curl_init($url);
    // On veut les headers
    curl_setopt($ch, CURLOPT_HEADER, true);
    // On veut pas le contenu
    curl_setopt($ch, CURLOPT_NOBODY, true);
    // On retourne le code HTML pour ne pas casser le JSON
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // On définit un timeout, on sait jamais
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    // Execution de la requête
    curl_exec($ch);
    // Récupération du code
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // Fin
    curl_close($ch);
    
    // Si le statut est OK on renvoi l'url sinon false
    return $statusCode == 200 ? $url : false;
    
  }
}
?>
