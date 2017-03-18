<?php 

namespace App\Traits; 

use Request;

/**
 * Class ApiRendering
 *
 * @package App\Traits
 */
trait ApiRendering
{
    /**
     * DEFINE and check for the content-type header.
     *
     * @return String  $type     The content-type the user wants.
     */
	public function checkAcceptEncoding()
	{
	    switch (Request::header('Accept')) {
            // CHECK xml types.
	        case 'text/xml':
	            $type = 'text/xml';
	            break;
            case 'application/xml':
                $type = 'application/xml';
                break;

            // CHECK applications.
            case 'text/json':
                $type = 'text/json';
                break;
            case 'application/json':
                $type = 'application/json';
                break;

            // No supported content-Type so return unknown.
            default: $type = 'application/json'; break;
        }

        return $type;
	}
}