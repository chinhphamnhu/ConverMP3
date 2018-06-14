<?php
require('youtube-dl.class.php');

if (trim($_POST["id"]) && trim($_POST["type"])) {
	$id = trim($_POST["id"]);
	$type = trim($_POST["type"]);

	switch ($type) {
		case 'audio':
			try {
				$youtube = new yt_downloader("https://www.youtube.com/watch?v=" . $id, TRUE, $type);
				$audio = $mytube->get_audio();
    			$path_dl = $mytube->get_downloads_dir();

    			clearstatcache();
				if($audio !== FALSE && file_exists($path_dl . $audio) !== FALSE) {
			        print "<a href='". $path_dl . $audio ."' target='_blank'>Click, to open downloaded audio file.</a>";
			    } else {
			        print "Oups. Something went wrong.";
			    }

    			$log = $mytube->get_ffmpeg_Logfile();
			    if($log !== FALSE) {
			        print "<br><a href='" . $log . "' target='_blank'>Click, to view the Ffmpeg file.</a>";
			    }
			} catch (Exception $e) {
    			die($e->getMessage());
			}
		case 'video':
			break;
		default:
			$obj->message = "Hello Viet Nam";
			print_r(json_encode($obj));
	}
}

?>