<?php

/*
 * Author - Little Pirate
 * Blog - http://lilpirate.net
 * Project URI - https://github.com/lilpirate/fql-cache
*/
class fql_cache extends Facebook {   
    
    private $cache_timeout = 24; // In hours
    private $use_cache = true;
    private $cache_dir = '.';
    private $debug = false;
    
    function __construct( $options ) {
        parent::__construct( $options );
    }
    
    public function enable_cache( ) {
        $this->use_cache = true;
    }
    
    public function disable_cache( ) {
        $this->use_cache = false;
    }
    
    public function enable_debug( ) {
        $this->debug = true;
    }
    
    public function disable_debug( ) {
        $this->debug = false;
    }
    
    public function set_cache_dir( $directory ) {
        $this->cache_dir = $directory;
    }
    
    public function set_cache_timeout( $timeout ) {
        $this->cache_timeout = $timeout;
    }
    
    public function set_options( $options ) {
        $this->use_cache = $options['use_cache'] ? true : false;
        $this->debug = $options['debug'] ? true : false;
        $this->cache_dir = is_dir( $options['cache_dir'] ) ? $options['cache_dir'] : $this->cache_dir ;
        $this->cache_timeout = is_numeric( $options['cache_timeout'] ) ? '' : $this->cache_timeout ;
    }
    
    public function fql_query( $query ) {
        if( $this->use_cache ) {
            $result = $this->get_cache( $query );                        
            if( $result['flag'] == false ) {              
                $result = $this->query_fql( $query );                                
                $this->store_cache( $query, $result );                
            }
        }
        else {
           $result = $this->query_fql( $query ); 
        }
        
        return $result;
    } 
    
    private function query_fql( $query ) {
        // Recommended method 
        $response = $this->api( array(
            'method' => 'fql.query',
            'query' => $query,
        ) );        
        // OR, for queries with access tokens
        /*
        $response = $this->api( array(
            'method' => 'fql.query',
            'access_token' => $cookie['access_token'],
            'query' => $query,
            'callback'  => ''
        ) );
         */  
        return $response;
    }   
    
    private function store_cache( $query, $result ) {
        $cache_file = $this->cache_dir . DIRECTORY_SEPARATOR . md5( $query );
        if ( !is_dir( $this->cache_dir ) )  {					
            $this->debug ? trigger_error("Could not open cache dir: $this->cache_dir",E_USER_WARNING) : null;
        }                                 
        else    {
            file_put_contents( $cache_file, serialize( $result ) );
        }			        
    }
    
    private function get_cache( $query )  {    
        $cache_file = $this->cache_dir . DIRECTORY_SEPARATOR . md5( $query );
        if ( file_exists( $cache_file ) ) {     
            if ( ( time() - filemtime( $cache_file ) ) > $this->cache_timeout * 3600 )  {
                unlink( $cache_file );
                return array( 'flag' => false );
            }
            else {
                $result = unserialize( file_get_contents( $cache_file ) );        
                return array( 'flag' => true , 'result' => $result );
            }
        }
        else
            return array( 'flag' => false );
    }
    
}