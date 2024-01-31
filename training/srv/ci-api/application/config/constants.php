<?php

$HTTP_HOST = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/* JWT */
define('JWT_SECRET_KEY','kzUf4sxss4AeG5uHkNZAqT1Nyi1zVfpz');
define('JWT_TIME_TO_LIVE',3600);



define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
getenv('FRONTEND_URL') ? define('FRONTEND_URL', getenv('FRONTEND_URL')): "";
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');



/* FITBIT settings START */
getenv('CLIENT_KEY') ? define('CLIENT_KEY', getenv('CLIENT_KEY')): "";
getenv('CLIENT_SECRET') ? define('CLIENT_SECRET', getenv('CLIENT_SECRET')): "";
define('FITBIT_REDIRECT_URI', 'http://' . $HTTP_HOST . '/fitbit/fitbitaccess');
getenv('FROM_EMAIL') ? define('FROM_EMAIL', getenv('FROM_EMAIL')): "";
getenv('SERVICE_EMAIL') ? define('SERVICE_EMAIL', getenv('SERVICE_EMAIL')) : "";

define('BAD_REQUEST', 400);
define('PERMANENT_REDIRECT', 301);
define('UNAUTHORIZED', 401);
define('FORBIDDEN', 403);
define('BAD_GATEWAY', 504);
define('SUCCESS_OK', 200);
define('PAGE_NOT_FOUND', 404);
define('INTERNAL_SERVER_ERROR', 500);
define('CONTENT_NOT_FOUND', 204);
define('ERROR', 'error');
define('PREMIUM_LIMIT_PERCENTAGE', 10);



//DB TABLES START
define('USER_STEPS', 'user_steps');
define('USER_CALORIES', 'user_calories');
define('USER_WEIGHTS', 'user_weights');
//DB TABLES END
//Twitter Keys
define('TWITTER_CUSTOMER_KEY', getenv('TWITTER_CUSTOMER_KEY'));
define('TWITTER_CUSTOMER_SECRET', getenv('TWITTER_CUSTOMER_SECRET'));
define('TWITTER_ACCESS_TOKEN', getenv('TWITTER_ACCESS_TOKEN'));
define('TWITTER_ACCESS_TOKEN_SECRET', getenv('TWITTER_ACCESS_TOKEN_SECRET'));



//stripe constants START
define('STRIPE_SECRET_KEY', getenv('STRIPE_SECRET_KEY'));
define('STRIPE_PUBLISHABLE_KEY', getenv('STRIPE_PUBLISHABLE_KEY'));
//stripe constants END
//Application Section Percentages
define('PERSONAL_INFO', 14);
define('BENEFICIARY_INFO', 16);
define('OWNERSHIP_INFO', 10);
define('OTHER_INSURANCE', 24);
define('REPLACEMENT', 6);
define('MEDICAL_INFO', 14);
define('PAYMENT_INFO', 11);

/* End of file constants.php */
define("GOALFREQUNCY", 3);
define('CACHEVERSION', getenv('CACHEVERSION'));
//define('SIGNUPURL', 'https://symetra.sureifylife.com/?source=ios&action=signup');
//steps limit
define('STEPS_LIMIT', 10000);
define('EXPIRY_TIME', 24);
define('CARRIER_PASSWORD_WRONG_ATTEMPTS', 5);
define("FREQUENCY", 30);

//CHALLENEGS
define('CHALLENGES_UPLOAD_PATH','challenges/');
define("CHALLENGE_DEFAULT_MIN_WIDTH",600);
define("CHALLENGE_DEFAULT_MIN_HEIGHT",400);
define('CHALLENGE_DEFAULT_MAX_SIZE', 5120);

define("CHALLENGE_MAE_WIDTH",127);
define("CHALLENGE_MAE_HEIGHT",127);

define("CHALLENGE_WT_WIDTH",262);
define("CHALLENGE_WT_HEIGHT",262);

define("CHALLENGE_WB_WIDTH",460);
define("CHALLENGE_WB_HEIGHT",262);

define("CHALLENGE_MT_WIDTH",324);
define("CHALLENGE_MT_HEIGHT",240);

define("CHALLENGE_MB_WIDTH",600);
define("CHALLENGE_MB_HEIGHT",400);

define("CARRIER_ID",1);


//stripe constants START
defined('VALIDIC_ORGANISATION_ID') OR define('VALIDIC_ORGANISATION_ID', getenv('VALIDIC_ORGANISATION_ID'));
defined('VALIDIC_ORGANISATION_ACCESS_TOKEN') OR define('VALIDIC_ORGANISATION_ACCESS_TOKEN', getenv('VALIDIC_ORGANISATION_ACCESS_TOKEN'));


//Captcha client key
//stripe constants END
//Image path
define('PROFILE_PIC_PATH', 'assets/uploadedfiles/profile_pictures/');
define('CHALLENGES_IMAGE_PATH', 'assets/uploadedfiles/challenges/');
define('PRODUCTS_IMAGE_PATH', 'assets/uploadedfiles/products/');
define('CATEGORY_IMAGE_PATH', 'assets/uploadedfiles/categories/images/');
define('CATEGORY_ICON_PATH', 'assets/uploadedfiles/categories/icons/');
define('GIFTCARD_PATH', 'assets/uploadedfiles/gift_store/');
define('CHARITY_PATH', 'assets/uploadedfiles/charities/');
define("FORM_START_YEAR", 1901);

//Constant for application process regular expressions
//Name field
//define("NAME_FIELD", "/^[a-zA-Z\.\s'-]+$/")
define("NAME_FIELD", "/^[a-zA-Z0-9\.\s\&'-]+$/");
//define("NAME_FIELD", "/^[]+$/");
define("NAME_WITH_SPACE", "/^[a-zA-Z\s]+$/");
define("BENF_RELATION", "/^[a-zA-Z\s-]+$/");
define("ALPHA_NUMERIC", "/^[0-9a-zA-Z]+$/");
define("CITY_FIELD", "/^[a-zA-Z\.\s',\-]+$/");
define("NUMERIC", "/^[0-9]+$/");
define("ZIPCODE_FIELD", "/(^\d{5}$)|(^\d{9}$)|(^\d{5}-\d{4}$)/");
define("SUBJECT_FIELD", "/^[a-zA-Z0-9\.\"\s\&'-]+$/");
define('CAPTCHA_SITE_KEY', getenv('CAPTCHA_SITE_KEY'));
define("ALPHA_NUMERIC_UNDERSCORE", "/^[0-9a-zA-Z_]+$/");


/* Location: ./application/config/constants.php */
#define("FB_APP_ID", getenv('FB_APP_ID'));
#define("FB_SECRET", getenv('FB_SECRET'));
define("FB_NO_DAYS_POSTS", "10");
define("FB_SYNC_TIME","900");

//Date format
define("DATE_FORMAT", "Y-m-d H:i:s");


//Constant for encryption
define("ENCRYPT_SALT", getenv('ENCRYPT_SALT'));

//Carrier
define("CARRIER", "2001");

//Tango Gift Cards
defined("TANGO_CUSTOMER_IDENTIFIER") OR define("TANGO_CUSTOMER_IDENTIFIER", getenv('TANGO_CUSTOMER_IDENTIFIER'));
defined("TANGO_ACCOUNT_IDENTIFIER") OR define("TANGO_ACCOUNT_IDENTIFIER", getenv('TANGO_ACCOUNT_IDENTIFIER'));
defined("TANGO_COMPANY_IDENTIFIER") OR define("TANGO_COMPANY_IDENTIFIER", getenv('TANGO_COMPANY_IDENTIFIER'));
defined("TANGO_COMPANY_SECRET") OR define("TANGO_COMPANY_SECRET", getenv('TANGO_COMPANY_SECRET'));
defined("TANGO_APP_MODE") OR define("TANGO_APP_MODE", getenv('TANGO_APP_MODE'));


define("VALIDATED", false);
// Last Seen Push Notifications
define("LAST_SEEN_PUSH_NOTIFICATION",120);

defined("DOCUSIGN_USERNAME") OR define("DOCUSIGN_USERNAME", getenv('DOCUSIGN_USERNAME'));
defined('DOCUSIGN_PASSWORD') OR define('DOCUSIGN_PASSWORD', getenv('DOCUSIGN_PASSWORD'));
defined('DOCUSIGN_INTEGRATOR_KEY') OR define('DOCUSIGN_INTEGRATOR_KEY', getenv('DOCUSIGN_INTEGRATOR_KEY'));
defined('DOCUSIGN_APP_MODE') OR define('DOCUSIGN_APP_MODE', getenv('DOCUSIGN_APP_MODE'));

defined("AWSIMAGEURL") OR define("AWSIMAGEURL", getenv('AWSIMAGEURL'));
defined('AWS_BUCKET') OR define('AWS_BUCKET', getenv('AWS_BUCKET'));
defined('AWS_PVT_BUCKET') OR define('AWS_PVT_BUCKET', getenv('AWS_PVT_BUCKET'));
defined('IMPORTED_USERS_PATH') OR define('IMPORTED_USERS_PATH', getenv('IMPORTED_USERS_PATH'));

getenv('FORGOTPASSWORD_URL') ? define('FORGOTPASSWORD_URL', getenv('FORGOTPASSWORD_URL')): "";

//define("FORGOTPASSWORD_URL", "https://web.sureifylifeco.com/");

getenv('AWSIMAGEURL') ? define('AWSIMAGEURL', getenv('AWSIMAGEURL')): "";
getenv('AWS_BUCKET') ? define('AWS_BUCKET', getenv('AWS_BUCKET')): "";
getenv('AWS_PVT_BUCKET') ? define('AWS_PVT_BUCKET', getenv('AWS_PVT_BUCKET')): "";
getenv('IMPORTED_USERS_PATH') ? define('IMPORTED_USERS_PATH', getenv('IMPORTED_USERS_PATH')): "";

getenv('API_AUTH_ID') ? define('API_AUTH_ID', getenv('API_AUTH_ID')): "";
getenv('API_AUTH_PWD') ? define('API_AUTH_PWD', getenv('API_AUTH_PWD')): "";
getenv('ANB_ORGANIZATION_ID') ? define('ANB_ORGANIZATION_ID', getenv('ANB_ORGANIZATION_ID')): "";
getenv('ANB_ORGANIZATION_ACCESS_TOKEN') ? define('ANB_ORGANIZATION_ACCESS_TOKEN', getenv('ANB_ORGANIZATION_ACCESS_TOKEN')): "";
getenv('APPLY_BUY_API') ? define('APPLY_BUY_API', getenv('APPLY_BUY_API')): "";

getenv('ORGANIZATION_ID') ? define('ORGANIZATION_ID', getenv('ORGANIZATION_ID')): "";
getenv('ORGANIZATION_ACCESS_TOKEN') ? define('ORGANIZATION_ACCESS_TOKEN', getenv('ORGANIZATION_ACCESS_TOKEN')): "";
getenv('API_URL') ? define('API_URL', getenv('API_URL')): "";

//Notification iOS Constants
define("IOS_PASSPHARASE", getenv('IOS_PASSPHARASE'));
define("IOS_PEMPATH", getenv('IOS_PEMPATH'));
define("IOS_CLIENT_URL", getenv('IOS_CLIENT_URL'));
define("IOS_FEEDBACK_URL", getenv('IOS_FEEDBACK_URL'));


define("TITLE", 25);

define("DESCRIPTION", 80);
//SUPPORT EMAIL
getenv('SUPPORT_EMAIL') ? define ('SUPPORT_EMAIL', getenv('SUPPORT_EMAIL')) : "";
define("FB_POSTS_LIMIT",200);
//GOALSTARTTIME

define("GOALSTARTTIME", '23:44');
//Constant for aes encryption
define("AES_IOS_KEY", getenv('AES_IOS_KEY'));
define("AES_IOS_BLOCKSIZE", "128");
define("AES_IOS_ENCRYPTIONMODE", 'ecb');
define("ANDROID_VERSION","1.1.9");
define("IOS_VERSION","1.1.9");
define("HELLOSIGN_CLIENT_KEY", getenv('HELLOSIGN_CLIENT_KEY'));
//SUPPORT EMAIL
//define("SUPPORT_EMAIL", "mails@sureify.com");
define("ALLOWED_IP_ADDRESES", serialize(array("127.0.0.1","183.82.121.219","103.209.88.45","103.246.45.98","96.72.165.101","52.90.38.85","175.101.8.49","124.123.85.235","223.237.28.244","103.57.135.51","27.63.121.14","223.182.85.178","223.237.22.191","223.237.15.225")));

define("VERSION_NUMBER", getenv('VERSION_NUMBER'));
define("CARPE_DATA_TOKEN", getenv('CARPE_DATA_TOKEN'));


define('CUSTOM_CONTENT_UPLOAD_PATH','customcontent/');
define('CC_THUMBNAIL_MAX_WIDTH',460);
define('CC_THUMBNAIL_MAX_HEIGHT', 166);
define('CC_THUMBNAIL_SIZE', 5120);
define('CC_IMAGE_MAX_WIDTH', 770);
define('CC_IMAGE_MAX_HEIGHT', 350);
define('CC_IMAGE_SIZE', 2048);
define('CC_THUMBNAIL_WEB_MAX_WIDTH', 350);
define('CC_THUMBNAIL_WEB_MAX_HEIGHT', 260);
define('CC_THUMBNAIL_WEB_SIZE', 2048);
define('CC_IMAGE_WEB_MAX_WIDTH', 900);
define('CC_IMAGE_WEB_MAX_HEIGHT', 350);
define('CC_IMAGE_WEB_SIZE', 2048);
define('CC_DESC_LIMIT', 1500);
define('CC_SHORT_DESC_LIMIT', 200);
define('CC_MODULE_TITLE_LIMIT', 20);
define('CC_CONTENT_TITLE_LIMIT', 20);
define("PHONE_NUMBER", "/^[0-9+]+$/");

//Sentiance API URL, ID and Tokens
define("SENTIANCE_API_URL","https://api.sentiance.com/v2");
define("SENTIANCE_ID", getenv('SENTIANCE_ID'));
define("SENTIANCE_TOKEN", getenv('SENTIANCE_TOKEN'));

define("WEB_URL", getenv('WEB_URL'));
define("NAME_NUMBER_FIELD", "/^[a-zA-Z0-9\.\s\&'-@#$]+$/");
define('SESSION_ACTIVITY_FEED_LIMIT', 30);



define('POLL_MAX_HEIGHT',350);
define('POLL_MAX_WIDTH', 500);
define('POLL_MAX_SIZE', 2048);


define('PRODUCT_MAX_WIDTH',150);
define('PRODUCT_MAX_HEIGHT', 150);
define('PRODUCT_MAX_SIZE', 2048);
define('PRODUCT_IMAGE_MAX_WIDTH', 300);
define('PRODUCT_IMAGE_MAX_HEIGHT', 200);
define('PRODUCT_IMAGE_SIZE', 2048);
define('PRODUCT_IMAGE_MAX_SIZE', 2048);


// Activity Metrics
define("SLEEP", "31007");
define("STEPS", "31001");
define("FLOORS", "31002");
define("CYCLING", "31004");
define("RUNNING", "31009");
define("CALORIES", "31006");
define("SWIMMING", "31010");
define("HEARTRATE", "31008");
define("WEIGHT_LOG", "12001");
define("MINDFULNESS", "31011");

define("PASSWORD_RESET_EMAIL_SUBJECT", "Password Reset Instructions");

define('SYNC_FROM_PAST_DAYS', 14);
define('SIGNUP_CONFIG_PERMISSION_NAME', "Signup Config");

define('GO_API_URL', getenv('GO_API_URL'));

//define("ACTIVITY_LOGS", "86000");

(ENVIRONMENT == 'local' || ENVIRONMENT == 'stg')? define('IP_VALIDATION', false): define('IP_VALIDATION', TRUE);

define('VIEWPATH', 'application/views/');
define("CONTACT_ADVISOR_EMAILS", serialize(array("mails@sureify.com")));

// DIFFERENT CONTENT TYPES
define('CHALLENGES', 43000);
define('SURVEY', 39000);
define('CUSTOM_CONTENT', 46000);
define('POLL_QUIZZ_VIDEO', 77000);
define('LEARNING_CENTER_ARTICLCE', 83000);
define('TIP', 79000);
define('PRODUCTS', 84000);
define('PRODUCT_CATEGORIES', 85000);
define('LEARNING_CENTER', 78000);


//Redis keys
define('REDIS_ONBOARDING_CONFIG', "onboarding_config");
define('REDIS_DASHBOARD_CONFIG', "dashboard_config");
define('REDIS_SLIDEMENU_CONFIG', "slidemenu_config");
define('REDIS_USER','user');
define('REDIS_TAGS','tags');
define('REDIS_TAG_ID','tag_id');

define('FAQ_CATEGORIES', 87000);
define('FAQS', 88000);

define('ENABLE_PUSHNOTIFICATION_TRIGGERS',FALSE);
define('ENABLE_MESSAGE_TRIGGERS',FALSE);
define('ENABLE_EMAIL_TRIGGERS',TRUE);

define('DASHBOARD_CONFIG_TYPE', 93001);
define('ONBOARDING_CONFIG_TYPE', 93002);
define('SLIDEMENU_CONFIG_TYPE', 93003);

define("LAPETUS_AGE_RANGE", 1);

/*define("CC_WT_WIDTH",350);
define("CC_WT_HEIGHT",262);

define("CC_WB_WIDTH",460);
define("CC_WB_HEIGHT",262);

define("CC_MT_WIDTH",600);
define("CC_MT_HEIGHT",300);

define("CC_MB_WIDTH",600);
define("CC_MB_HEIGHT",400);*/


define("SMTP_HOST",getenv('SMTP_HOST'));
define("SMTP_PORT",getenv('SMTP_PORT'));
define("SMTP_USERNAME",getenv('SMTP_USERNAME'));
define("SMTP_PASSWORD",getenv('SMTP_PASSWORD'));

define('SFTP_HOST', getenv('SFTP_HOST'));
define('SFTP_USER_NAME', getenv('SFTP_USER_NAME'));
define('SFTP_ACCESS_KEY', getenv('SFTP_ACCESS_KEY'));
define('SFTP_FOLDER_PATH', getenv('SFTP_FOLDER_PATH'));
define('PAYMENT_SFTP_FOLDER', getenv('PAYMENT_SFTP_FOLDER'));

define("INSERT_BATCH_LIMIT", 100);

define('LN_URL', getenv('LN_URL'));
define('LN_ACCOUNT_ID', getenv('LN_ACCOUNT_ID'));
define('LN_ACCOUNT_NAME', getenv('LN_ACCOUNT_NAME'));
define('LN_AUTHORIZATION', getenv('LN_AUTHORIZATION'));
define('LN_ACCOUNT_MODE', getenv('LN_ACCOUNT_MODE'));

define('AWS_ACCESS_KEY_ID',getenv('AWS_ACCESS_KEY_ID'));
define('AWS_SECRET_ACCESS_KEY',getenv('AWS_SECRET_ACCESS_KEY'));
define('AWS_PVT_KMS_KEY_ID',getenv('AWS_PVT_KMS_KEY_ID'));
define('AWS_SECURED',getenv('AWS_SECURED'));

getenv('OTP_BCC') ? define ( 'OTP_BCC', getenv('OTP_BCC')) : "";
define('OTP_EXPIRE_TIME',10);

# Used for fetching logs from paper trail
define('PAPERTRAIL_TOKEN', getenv('PAPERTRAIL_TOKEN')); // Token for a given account can be found at https://papertrailapp.com/account/profile
define('PAPERTRAIL_SYSTEM_ID', 'AAA-API-DEV');
define('FB_RECONNECT_DAYS', 30);

define('REDIS_PAYMENTS_CONFIG', "payments_config");
define('PAYMENT_CONFIG_TYPE', 93008);


defined('WET_SIGNATURE_STATUS') OR define('WET_SIGNATURE_STATUS', '70010' );

defined('DATA_ENCRYPTION') OR define('DATA_ENCRYPTION', '0');

getenv('QUOTE_GUID') ? define('QUOTE_GUID', getenv('QUOTE_GUID')): "";
getenv('FROM_EMAIL_ADDRESS') ? define('FROM_EMAIL_ADDRESS', getenv('FROM_EMAIL_ADDRESS')): "";
getenv('EMAIL_DISPLAY_NAME') ? define('EMAIL_DISPLAY_NAME', getenv('EMAIL_DISPLAY_NAME')): "";
getenv('WEB_APP_SITE_URL') ? define('WEB_APP_SITE_URL', getenv('WEB_APP_SITE_URL')): "";
getenv('YOUR_TEAM_EMAIL') ? define('YOUR_TEAM_EMAIL', getenv('YOUR_TEAM_EMAIL')): "";


//Constants to call ANB API to display questions tab applicant info 
//(Sales -> applicants -> applicantinfo)
getenv('REVIEW_URL') ? define('REVIEW_URL', getenv('REVIEW_URL')): "";
getenv('APPLY_BUY_API') ? define('APPLY_BUY_API', getenv('APPLY_BUY_API')): "";
getenv('ANB_API_AUTH_ID') ? define('ANB_API_AUTH_ID', getenv('ANB_API_AUTH_ID')): "";
getenv('ANB_API_AUTH_PWD') ? define('ANB_API_AUTH_PWD', getenv('ANB_API_AUTH_PWD')): "";
getenv('ANB_ORGANIZATION_ID') ? define('ANB_ORGANIZATION_ID', getenv('ANB_ORGANIZATION_ID')): "";
getenv('ANB_ORGANIZATION_ACCESS_TOKEN') ? define('ANB_ORGANIZATION_ACCESS_TOKEN', getenv('ANB_ORGANIZATION_ACCESS_TOKEN')): "";
//(ENVIRONMENT == 'uat' || ENVIRONMENT == 'prod')? define('IP_ADMIN_VALIDATION', TRUE): define('IP_ADMIN_VALIDATION', FALSE);
define('IP_ADMIN_VALIDATION', FALSE);
getenv('CARRIER_NAME') ? define('CARRIER_NAME', getenv('CARRIER_NAME')): "";

//Constants for cron job
getenv('BENE_SFTP_PATH') ? define('BENE_SFTP_PATH', getenv('BENE_SFTP_PATH')): "";
getenv('BENE_FILE_KEY') ? define('BENE_FILE_KEY', getenv('BENE_FILE_KEY')): "";
getenv('BENE_S3_FOLDER') ? define('BENE_S3_FOLDER', getenv('BENE_S3_FOLDER')): "";

getenv('INFORCE_SFTP_PATH') ? define('INFORCE_SFTP_PATH', getenv('INFORCE_SFTP_PATH')): "";
getenv('INFORCE_S3_FOLDER') ? define('INFORCE_S3_FOLDER', getenv('INFORCE_S3_FOLDER')): "";
getenv('INFORCE_FILE_KEY') ? define('INFORCE_FILE_KEY', getenv('INFORCE_FILE_KEY')): "";

getenv('PENDING_SFTP_PATH') ? define('PENDING_SFTP_PATH', getenv('PENDING_SFTP_PATH')): "";
getenv('PENDING_S3_FOLDER') ? define('PENDING_S3_FOLDER', getenv('PENDING_S3_FOLDER')): "";
getenv('PENDING_FILE_KEY') ? define('PENDING_FILE_KEY', getenv('PENDING_FILE_KEY')): "";

getenv('APPID_SFTP_PATH') ? define('APPID_SFTP_PATH', getenv('APPID_SFTP_PATH')): "";
getenv('APPID_S3_FOLDER') ? define('APPID_S3_FOLDER', getenv('APPID_S3_FOLDER')): "";
getenv('APPID_FILE_KEY') ? define('APPID_FILE_KEY', getenv('APPID_FILE_KEY')): "";

getenv('USERS_SFTP_PATH') ? define('USERS_SFTP_PATH', getenv('USERS_SFTP_PATH')): "";
getenv('USERS_FILE_KEY') ? define('USERS_FILE_KEY', getenv('USERS_FILE_KEY')): "";
getenv('USERS_S3_FOLDER') ? define('USERS_S3_FOLDER', getenv('USERS_S3_FOLDER')): "";
getenv('SFTP_CHANGE_FOLDER_PATH') ? define('SFTP_CHANGE_FOLDER_PATH', getenv('SFTP_CHANGE_FOLDER_PATH')): "";
getenv('SAML_AUTH_CALLBACK_FUNCTION') ? define('SAML_AUTH_CALLBACK_FUNCTION', getenv('SAML_AUTH_CALLBACK_FUNCTION')): "";
