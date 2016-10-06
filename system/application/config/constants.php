<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
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


define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

if($_SERVER['SERVER_NAME']=='localhost') {
define('ROOT_PATH','');
define('ADMIN_PATH','admin');             // config admin path
define('PROFILE_IMAGES_THUMB','user_profile_images_thumb');             // config admin path
define('PROFILE_IMAGES','user_profile_images');             // config admin path
define('UPLOADS','uploads');             // config admin path
define('FRIENDS','friends_images');             // config admin path
define('PHOTO_QUESTION_THUMB','photo_question_thumbs');
define('VIDEO_QUESTION_THUMB','converted_video_images/converted_video_images_thumbs');
define('USER_UPLOADED_PHOTOS','user_uploaded_photos');
define('UPLOADED_VIDEO_QUESTIONS','uploaded_video_questions');
define('UPLOADED_VIDEO_ANSWERS','uploaded_video_answers');
define('UPLOADED_VIDEOS','uploaded_videos');
define('GAMEBOARD_IMAGES','gameboard_images');
define('IMAGES','images');
define('GAMEBOARD_THUMB_IMAGES','gameboard_thumb_images');
}
else if($_SERVER['SERVER_NAME']=='www.proshore.eu' || $_SERVER['SERVER_NAME']== 'proshore' || $_SERVER['SERVER_NAME']== 'proshore.eu') {
#define('ROOT_PATH',"/home/proshore/domains/proshore.eu/public_html/clients/wannaquiz/");
#define('ROOT_PATH',"\home\proshore\domains\proshore.eu\public_html\clients\wannaquiz\\");
define('ROOT_PATH','');
define('ADMIN_PATH',ROOT_PATH . 'admin');             // config admin path
define('PROFILE_IMAGES_THUMB',ROOT_PATH . 'user_profile_images_thumb');             // config admin path
define('PROFILE_IMAGES',ROOT_PATH . 'user_profile_images');             // config admin path
define('UPLOADS',ROOT_PATH . 'uploads');             // config admin path
define('FRIENDS',ROOT_PATH . 'friends_images');             // config admin path
define('PHOTO_QUESTION_THUMB',ROOT_PATH . 'photo_question_thumbs');
define('PHOTO_QUESTION_IMAGES',ROOT_PATH . 'photo_question_images');
define('VIDEO_QUESTION_THUMB',ROOT_PATH . 'converted_video_images/converted_video_images_thumbs');
define('USER_UPLOADED_PHOTOS',ROOT_PATH . 'user_uploaded_photos');
define('UPLOADED_VIDEO_QUESTIONS',ROOT_PATH . 'uploaded_video_questions');
define('UPLOADED_VIDEO_ANSWERS',ROOT_PATH . 'uploaded_video_answers');
define('UPLOADED_VIDEOS',ROOT_PATH . 'uploaded_videos');
define('GAMEBOARD_IMAGES',ROOT_PATH . 'gameboard_images');
define('IMAGES',ROOT_PATH . 'images');
define('GAMEBOARD_THUMB_IMAGES',ROOT_PATH . 'gameboard_thumb_images');
}
else if($_SERVER['SERVER_NAME']=='www.wannaquiz.com' || $_SERVER['SERVER_NAME']== 'wannaquiz' || $_SERVER['SERVER_NAME']== 'wannaquiz.com') {
define('ROOT_PATH','home/wannaquiz/domains/wannaquiz.com/public_html/');
define('ADMIN_PATH','admin');             // config admin path
define('PROFILE_IMAGES_THUMB',ROOT_PATH . 'user_profile_images_thumb');             // config admin path
define('PROFILE_IMAGES',ROOT_PATH . 'user_profile_images');             // config admin path
define('UPLOADS',ROOT_PATH . 'uploads');             // config admin path
define('FRIENDS',ROOT_PATH . 'friends_images');             // config admin path
define('PHOTO_QUESTION_THUMB',ROOT_PATH . 'photo_question_thumbs');
define('VIDEO_QUESTION_IMAGE',ROOT_PATH . 'converted_video_images');
define('VIDEO_QUESTION_THUMB',ROOT_PATH . 'converted_video_images/converted_video_images_thumbs');
define('USER_UPLOADED_PHOTOS',ROOT_PATH . 'user_uploaded_photos');
define('UPLOADED_VIDEO_QUESTIONS',ROOT_PATH . 'uploaded_video_questions');
define('UPLOADED_VIDEO_ANSWERS',ROOT_PATH . 'uploaded_video_answers');
define('UPLOADED_VIDEOS',ROOT_PATH . 'uploaded_videos');
define('GAMEBOARD_IMAGES',ROOT_PATH . 'gameboard_images');
define('IMAGES',ROOT_PATH . 'images');
define('GAMEBOARD_THUMB_IMAGES',ROOT_PATH . 'gameboard_thumb_images');

}

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */