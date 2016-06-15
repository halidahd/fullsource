<?php
$page = isset($_GET['type']) ? $_GET['type'] : '';

if (!$page) {
	header('HTTP/1.1 404 Not Found');
	exit;
}

$tempAPI = dirname(__FILE__) . "/" . strtolower($page) . ".php";

if (is_readable($tempAPI)) {

	require_once $tempAPI;
	$tempAPIClass = strtolower($page);

	if (!class_exists($tempAPIClass, false)) {
		header('HTTP/1.1 404 Not Found');
		exit;
	}

	$handlerResponse = new $tempAPIClass();

	$handlerResponse->Process();
}

header('HTTP/1.1 404 Not Found');
exit;