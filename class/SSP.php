<?php
namespace App;

/*
 * Helper functions for building a DataTables server-side processing API calls (Built by : khalid el masnaoui)
 *
 */

use App\MailerLiteApiRequests;
use App\ProcessResponeData;


class SSP
{

	
	/**
	 * limit (for paging)
	 *
	 * Construct the LIMIT clause for server-side processing API calls
	 *
	 * @param  array $request Data sent to server by DataTables
	 * @return array
	 */
	static function limit($request)
	{
		$limit = [];

		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = [$request['start'],$request['length']];
		}

		return $limit;
	}


	/**
	 * getEmailOrderbyString (for Ordering)
	 *
	 * Construct the ORDER BY clause for server-side processing API calls
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @return string email order by paramter
	 */
	static function getEmailOrderbyString($request)
	{
		$orderBy = '';

		if (isset($request['order']) && count($request['order']) ) {
			$orderBy = $request['order'][0]['dir']; //because for now we order only by email field
		}


		return $orderBy;
	}


	/**
	 * Searching / Filtering
	 *
	 * Construct the WHERE paramter for server-side processing API call.
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @return string API call where paramter
	 */
	static function filterEmailText($request)
	{


		if (isset($request['search']) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];
            return $str;
	
		}
        return '';


	}


	/**
	 * simple
	 * 
	 * Perform the API calls needed for a server-side processing requested,
	 * utilising the helper functions of this class, limit(), getEmailOrderbyString() and
	 * filterEmailText() to add the paramters to the API call. The returned array is ready to be encoded as JSON
	 * in response to an SSP request, or can be modified if needed before
	 * sending back to the client.
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  string $key api key
	 *  
	 *  @return array  Server-side processing response array
	 */
	static function simple($request, $key )
	{
	

		// Build the paramters of API's request
		$limit = self::limit( $request);
		$order = self::getEmailOrderbyString( $request);
		$filter_email_value = self::filterEmailText($request);

		// Main query to actually get the data
       
		$requestToMailerLiteApi =  new MailerLiteApiRequests($key); 
		$proccessedResponse=  new ProcessResponeData();


		//request without limit because of we need to know the item count for the pagination to work
		$response = $requestToMailerLiteApi->sendRequestToMailerLiteAPISdk($order,[]);
		$response = $proccessedResponse->process($response);
		$recordsTotal=count($response);
		$recordsFiltered=$recordsTotal;

		if ($filter_email_value=='') { //no filter
			$response = $requestToMailerLiteApi->sendRequestToMailerLiteAPISdk($order,$limit);
			$response = $proccessedResponse->process($response);


		} else { //with filtering

			$response = $requestToMailerLiteApi->sendRequestToMailerLiteAPISdk($order,[],$filter_email_value);
			$response = $proccessedResponse->process($response);


			$recordsTotal=count($response);


			//we cant filter the data because  where paramter is not working in mailerlite api (an internal issue?)
			$response = $requestToMailerLiteApi->sendRequestToMailerLiteAPISdk($order,$limit,$filter_email_value); 
			$response = $proccessedResponse->process($response);



			$recordsFiltered==count($response);
		}
        

		/*
		 * Output
		 */
		return array(
			"draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) :0,
                "where" => $filter_email_value,
				"order"=> $order,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => $response 	);
	}








	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal methods
	 */

	/**
	 * Throw a fatal error.
	 *
	 * This writes out an error message in a JSON string which DataTables will
	 * see and show to the user in the browser.
	 *
	 * @param  string $msg Message to send to the client
	 */
	static function fatal($msg)
	{
		echo json_encode( array( 
			"error" => $msg
		) );

		exit(0);
	}

	


	
}



