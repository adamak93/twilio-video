<?php
require_once('./twilio-php/Services/Twilio.php');
//require_once('./randos.php');
require_once('./config.php');
 header("Access-Control-Allow-Origin: *");

// An identifier for your app - can be anything you'd like
$appName = 'TwilioVideo';

// choose a random username for the connecting user
$identity = 'Arcturus';

// Create access token, which we will serialize and send to the client
$token = new Services_Twilio_AccessToken(
    $TWILIO_ACCOUNT_SID,
    $TWILIO_API_KEY,
    $TWILIO_API_SECRET,
    3600,
    $identity
);

// Grant access to Conversations
$grant = new Services_Twilio_Auth_ConversationsGrant();
$grant->setConfigurationProfileSid($TWILIO_CONFIGURATION_SID);
$token->addGrant($grant);

// return serialized token and the user's randomly generated ID
echo json_encode(array(
    'identity' => $identity,
    'token' => $token->toJWT(),
));
