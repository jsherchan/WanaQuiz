<? 
    $v = exec('ffmpeg -sameq -i /home/proshore/domains/wannaquiz.com/public_html/uploaded_videos/melt5948.mpg -s 483x270 -ar 22050 -b 300000 -ab 128 -f flv -r 25 - | flvtool2 -U stdin /home/proshore/domains/wannaquiz.com/public_html/converted_videos/melt33665.flv',$output); 
    echo 'output of command : ffmpeg -sameq -i /home/proshore/domains/wannaquiz.com/public_html/uploaded_videos/melt5948.mpg -s 483x270 -ar 22050 -b 300000 -ab 128 -f flv -r 25 - | flvtool2 -U stdin /home/proshore/domains/wannaquiz.com/public_html/converted_videos/melt33565.flv <br ><pre>';
    print_r($output);
    echo '</pre><br>';
    $v = exec('ls',$output2);
    echo 'output of command : ls <br> <pre>';
    print_r($output2);
    echo '</pre>';
?>