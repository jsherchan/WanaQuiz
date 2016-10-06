<?php
		if($_SERVER['HTTP_HOST'] == 'localhost')
		{
			$base_url = 'http://localhost/wannaquiz/';
		}
		else
		{
			$base_url = 'http://interacto.eu/testvideo/';
		}
		if(isset($_GET['file']))
		{
			$file = $_GET['file'];
			$image = str_replace('.flv','.png',$file);
		}
?>

<script type="text/javascript" src="flowplayer/flowplayer-3.1.4.min.js"></script>

<strong>Below is the processed video</strong>
            <br /><br />
            <a  
                href="http://localhost/wannaquiz/uploaded_videos/<?php echo $file?>"  
                style="display:block;width:425px;height:300px;"  
                id="player"> 
            </a>
			<script language="JavaScript"> 
				flowplayer("player", "flowplayer/flowplayer-3.1.5.swf",{
                                    clip: {
                            
                                        autoPlay: true,
                                        autoBuffering: true // <- do not place a comma here
                                    }
                                });
			</script>

                
          