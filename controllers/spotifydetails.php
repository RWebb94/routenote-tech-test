<?php
require '../vendor/autoload.php';

class SpotifyDetails {

	// Global Variable setup
	protected $clientid;
	protected $clientsecret;
	protected $api;

	/*
	 * Constructor function is used to run authorisation on every call
	 */
	function __construct() {
		$this->setClientId('e5c49b2716484bc1bcd6a0de144ccede');
		$this->setClientSecret('fc282c643e22461c8fb29a35d4263de4');
		$this->getAuthorisation();
	}

	/*
	 * Used to determine which function to call
	 */
	public function _routing() {
		// Workout which function to call
		Flight::route( 'POST /api/spotifydetails/searchArtists', array($this, 'searchForArtists') );
		Flight::route( 'GET /api/spotifydetails/getArtistsTopTracks/@artistid', array($this, 'getArtistsTopTracks') );
	}

	/*
	 * Used to Set the Client ID Value
	 * @param	str		$clientid The client id value
	 */
	function setClientId($clientid) {
		$this->clientid = $clientid;
	}
	
	/*
	 * Used to Set the Client Secret Value
	 * @param	str		$clientsecret The client secret value
	 */
	function setClientSecret($clientsecret) {
		$this->clientsecret = $clientsecret;
	}
	
	/*
	 * Used to Set the Artist ID Value
	 * @param	str		$artistid The relevant artists spotify id
	 */
	function setArtistId($artistid) {
		$this->artistid = $artistid;
	}
	
	/*
	 * Used to retrieve the access token for authorisation
	 */
	function getAuthorisation() {
		$session = new SpotifyWebAPI\Session(
			$this->clientid,
			$this->clientsecret
		);

		$session->requestCredentialsToken();
		$accessToken = $session->getAccessToken();

		Flight::get('spotify')->setAccessToken($accessToken);
	}
	
	/*
	 * Used to search for an Artist
	 * @return	object	$artists An object of the matching artists
	 */
	function searchForArtists() {
	$searchstring = Flight::request()->data->searchstring;
		$options = [
			'offset'	=> 0,
			'limit'		=> 10
		];
		$artists = Flight::get('spotify')->search($searchstring, 'artist', $options);
		
		// Format and return results
		Flight::json($artists);
	}
	
	/*
	 * Used to get an Artists top tracks
	 * @return	object	$toptracks An object of the artists top tracks
	 */
	function getArtistsTopTracks($artistid) {
		$toptracks = Flight::get('spotify')->getArtistTopTracks($artistid, array('country' => 'GB'));
	
		// Format and return results
		Flight::json($toptracks);
	}
}

