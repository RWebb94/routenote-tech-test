<?php
	// Get project root
    $_SERVER['PROJECT_ROOT'] = dirname(__DIR__, 1);

	// Need to include composer auto load and the spotify php files
	require '../vendor/autoload.php';
	require '../controllers/spotifydetails.php';

	// Setup Flights Spotify API Call
	Flight::set('spotify', new SpotifyWebAPI\SpotifyWebAPI());

	// Call the Routing function
	$spotifyAPI = new SpotifyDetails();
	$spotifyAPI->_routing();

	// Start FlightPHP
	Flight::start();