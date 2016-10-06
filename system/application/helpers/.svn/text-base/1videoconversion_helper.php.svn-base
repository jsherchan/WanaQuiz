<?php 

function convert_media($filename, $rootpath, $inputpath, $outputpath, $width, $height, $bitrate, $samplingrate)
{
    //echo $filename.'/'.$rootpath.'/'.$inputpath.'/'.$outputpath.'/';
	$outfile = "";
	// root directory path, where FFMPEG folder exist in your application.
	$rPath = $rootpath."\ffmpeg";
	
	// which shows FFMPEG folder exist on the root.
	// Set Media Size that is width and hieght
	$size = $width."x".$height;
	// remove origination extension from file adn add .flv extension, becuase we must give output file name to ffmpeg command.
	$outfile =$filename;
	$out=explode(".",$outfile);
	
	
	// Media Size
	//$size = Width & "x" & Height;
	
	// remove origination extenstion from file and add .flv extension , becuase we must give output filename to ffmpeg command.
	
	$outfile = $out[0].".flv";
	// Use exec command to access command prompt to execute the following FFMPEG Command and convert video to flv format.
	
	//$ffmpegcmd1 ="ffmpeg -i ".$inputpath."/".$filename." -ab ".$bitrate. " -ar " .$samplingrate." -b 500 -r 15 -s ".$size." ".$outputpath."/".$outfile;
	
		
	//in proshore.eu
       //$ffmpegcmd1 = "/usr/local/bin/ffmpeg -sameq -i ".$inputpath."/".$filename." -s 483x270 -ar 22050 -b 300000 -ab 128 -f flv -r 25  - | /usr/bin/flvtool2 -U stdin ".$outputpath."/".$outfile;
		//$ffmpegcmd1 = "D:\Projects\xampp\htdocs\wannaquiz\ffmpeg -i ".$inputpath."/".$filename." -ar 22050 -b 300000 -ab 128 -f flv -r 25 -s 556x310 - | /usr/bin/flvtool2 -U stdin ".$outputpath."/".$outfile;
                $ffmpegcmd1 = "D:/wamp/www/wannaquiz/ffmpeg -i ".$inputpath."/".$filename." -ar 22050 -b 300000 -ab 128 -f flv -r 25 ".$outputpath."/".$outfile;
	$ret =exec($ffmpegcmd1);
	// return output file name for other operations
	return $ffmpegcmd1;
}


function grab_image($filename, $rootpath, $inputpath,$outputpath, $no_of_thumbs, $frame_number, $image_format, $width, $height)
{
	// root directory path
	$_rootpath = $rootpath."\ffmpeg";
	// Media Size
	$size = $width."x".$height;
	
	// I am using static image, you can dynamic it with your own choice.
	$out=explode(".",$filename);
	
	$outfile = $out[0].".jpg";
	
	//$ffmpegcmd1="/usr/local/bin/ffmpeg -i ".$inputpath."/".$filename." -ss 1.4 -vframes 1 -f image2 ". $outputpath."/".$outfile;
	//$ffmpegcmd1="ffmpeg -i ".$inputpath."/".$filename." -ss 1.4 -vframes 1 -f image2 ". $outputpath."/".$outfile;
	
	//in proshore
	//$ffmpegcmd1="/usr/local/bin/ffmpeg -i ".$inputpath."/".$filename." -ss 1.4 -vframes 1 -f image2 ". $outputpath."/".$outfile;
	$ffmpegcmd1="D:/wamp/www/wannaquiz/ffmpeg -i ".$inputpath."/".$filename." -ss 1.4 -vframes 1 -f image2 ". $outputpath."/".$outfile;

	$ret =shell_exec($ffmpegcmd1);
	
	// Execute this command using exec command or any other tool to grab image from converted flv file.
	return $ffmpegcmd1;
}

function video_length($inputpath,$filename){
    //Total Length of video can be userful at many cases. Following code sample shows
    // how to get the total length or duration of any video file


    //turn on the output buffering
    ob_start();

    //execute the the ffmpef command, where -i is the input
    //the 2>&1 is done to redirect standard error (stderr) to standard output(stdout)
    system("D:/wamp/www/wannaquiz/ffmpeg -i ".$inputpath."/".$filename." 2>&1");
    //now get the contents
    $totalDuration = ob_get_contents();

    //clear the output buffer and turn off the output buffering done by ob_start()
    ob_end_clean();

    //perform a regular expression match
    //check for the pattern Duration: ... in $duration and return matches
    preg_match('/Duration: (.*?),/', $totalDuration, $matches);

    //found the matches
    //this is the total length of video
    $totalLength = $matches[1];
    return $totalLength;
}
?> 