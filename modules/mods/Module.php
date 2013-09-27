<?

/**
 * Abstract module object for loading modules
 * 
 * @author 1Rogue
 */
interface Module {
    
    public function getHeader();
    public function getContent();
    public function getFooter();
    public function getName();
    
}

?>
