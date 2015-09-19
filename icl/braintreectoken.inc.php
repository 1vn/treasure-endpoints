<?php

function braintreectoken(){
	echo($clientToken = Braintree_ClientToken::generate());
}