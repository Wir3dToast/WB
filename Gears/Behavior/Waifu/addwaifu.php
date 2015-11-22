<?php

include($_SERVER['DOCUMENT_ROOT'] . "/include.php");
require($_SERVER['DOCUMENT_ROOT'] . "/Common/img.php");


$post_array = array('firstname','lastname','haircolor','eyecolor','height','weight','bustsize','hipsize','waistsize','bodytype','personality');
$avatar_img = $_FILES['avatar']['tmp_name'];


if(isset($_POST) && !array_diff($post_array, array_keys($_POST)) && ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK)) {

	$SANTIZER = new InputSanitizer($_POST);


	//Will think of better sanitize flags. Will add validation steps as well. Remember to santize avatar as well.

	$SANTIZER->addFilter("firstname",FILTER_SANITIZE_STRING);
	$SANTIZER->addFilter("lastname",FILTER_SANITIZE_STRING);
	$SANTIZER->addFilter("haircolor",FILTER_SANITIZE_STRING);
	$SANTIZER->addFilter("eyecolor",FILTER_SANITIZE_STRING);
	$SANTIZER->addFilter("height",FILTER_SANITIZE_NUMBER_INT);
	$SANTIZER->addFilter("weight",FILTER_SANITIZE_NUMBER_INT);
	$SANTIZER->addFilter("bustsize",FILTER_SANITIZE_NUMBER_INT);
	$SANTIZER->addFilter("hipsize",FILTER_SANITIZE_NUMBER_INT);
	$SANTIZER->addFilter("waistsize",FILTER_SANITIZE_NUMBER_INT);
	$SANTIZER->addFilter("bodytype",FILTER_SANITIZE_STRING);
	$SANTIZER->addFilter("personality",FILTER_SANITIZE_STRING);

	$sant_array = $SANTIZER->filter(); 

	$connection = $DB->connect();

	/*Error handling?*/

	$img_mang = new ImageManager($avatar_img);

	$img_mang->saveImgonServer($sant_array[0] . $sant_array[1]); //Very flawed. Need to change naming scheme. 

	(new sqlDBExecute($connection, "INSERT into CHARACTER VALUES(nextval('Character_CharacterID_seq'),$1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11)",$sant_array))->execute();
}

?>