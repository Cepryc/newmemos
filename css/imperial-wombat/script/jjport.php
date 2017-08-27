<?php
/** 
 * Include xmlrpc library
 * 
 * Site of the project: http://phpxmlrpc.sourceforge.net/
 * 
 */
include('lib/xmlrpc.inc');

/** 
 * LiveJournal Port
 * 
 * @author: Andrey Nikishaev
 * @site: http://andreynikishaev.livejournal.com
 */
class port {
	var $POST;
	var $cli;

	/**
	 * Create XML-RPC Client
	 *
	 */
	public function __construct() {
		//create XML-RPC Client
		$this->cli= new xmlrpc_client("/interface/xmlrpc", "www.livejournal.com", 80);
		//set connection encoding to UTF-8
		$this->cli->request_charset_encoding = "UTF-8";
		//set data encoding to UTF-8
		$GLOBALS['xmlrpc_internalencoding']='UTF-8';
	}
	
			
		
	}
