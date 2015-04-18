<?php
namespace IO\Api\Search\Engines;

class Dvpio {
  
  protected $online   = true;                 // Moteur disponible dans la liste ?
  protected $uri      = 'dvp.io';             // Site sur lequel on effectue une recherche (pour l'affichage)
  protected $api      = 'http://api.dvp.io';  // API du site sur lequel on effectue la recherche
  
  /* @method query
   * @access public
   * @param string $query The requested query
   * @return array List of results
   * @description La méthode query est invoquée par le gestionnaire de moteurs,
   *              cette méthode doit obligatoirement être publique
   *              la méthode doit obligatoirement retouner un tableau avec les enregistrements
   *              [
   *                'items' => [
   *                  [
   *                    title => Titre du lien, par défaut c'est $query (remplacez les + par des espaces),
   *                    target => URI de destination,
   *                    text => Texte affiché
   *                  ],
   *                  [...]
   *                ]
   *              ]
   *            Titre n'est pas supporté par le client natif mais le sera par le client alternatif, pensez donc à mettre le titre comme il faut :)
   */
  public function query($query) {
    
    /* Ici vous pouvez utiliser cURL pour effectuer votre requête
     * Vous pouvez déléguer les tâches à des méthodes privées
     */
    
    return $result; // La méthode doit toujours retourner un array contenant les items
  }
  
  /* Méthode déterminant l'état du moteur */
  public function isOnline() {
    return $this->online;
  }
}
?>
