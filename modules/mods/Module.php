<?

/**
 * Abstract module object for loading modules
 * 
 * @author 1Rogue
 */
interface Module {
    
    /**
     * Returns the header to use for the module
     */
    public function getHeader();
    
    /**
     * Returns content for the module
     */
    public function getContent();
    
    /**
     * Returns the footer for the module
     */
    public function getFooter();
    
    /**
     * Returns the name of the module
     */
    public function getName();
    
}

?>
