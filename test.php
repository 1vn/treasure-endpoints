<?
require_once('config.php');
define("PATH_SDK_ROOT", "v3-php-sdk-2.1.0/");
define("POPO_CLASS_PATH", "v3-php-sdk-2.1.0/Data/");
require_once('v3-php-sdk-2.1.0/Core/ServiceContext.php');
require_once('v3-php-sdk-2.1.0/DataService/DataService.php');
require_once('v3-php-sdk-2.1.0/PlatformService/PlatformService.php');
require_once('v3-php-sdk-2.1.0/Utility/Configuration/ConfigurationManager.php');
$requestValidator = new OAuthRequestValidator('mdIsgUm2nkJT2ipejzpqPFulg3C3D4uS2wYugMlB', 'qyprdK3uLE8xNDOcwU2jSbszw8hHcfyHUD6cgrraoF45S26c', 'qyprdIC8nkvT02iNkNT6zjodJBsY9d', 'ne6eilHlnis9uj71Cbs0uiA7HeaNQVrfZmd25cPf');
$realmid="405202781";
$serviceType= IntuitServicesType::QBD;
$serviceContext = new ServiceContext($realmId, $serviceType, $requestValidator);
$dataService = new DataService($serviceContext);
$entities = $dataService->Query("SELECT * FROM Customer");
echo $entities;