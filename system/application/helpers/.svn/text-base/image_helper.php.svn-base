<?php

function image_thumb($image_path,$thumb_path,$file_name, $height, $width)
{
	// Get the CodeIgniter super object
	$CI =& get_instance();
	
	// Path to image thumbnail
	$image_thumb =$thumb_path. '/' . $file_name;
	
	if( ! file_exists($image_thumb))
	{
		
		$CI->load->library('image_lib');
		
		// CONFIGURE IMAGE LIBRARY
		$config['image_library']	= 'gd2';
		$config['source_image']		= $image_path;
		$config['new_image']		= $image_thumb;
		$config['maintain_ratio']	= TRUE;
		$config['height']			= $height;
		$config['width']			= $width;
                $config['quality']              = '100';
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
	}
	
	return $image_thumb;
}


function getGameboardWithImage($stamp_image,$frameimage,$new_filename){
    //echo $stamp_image.'/'.$frameimage.'/'.$new_filename;exit;
                        $type="free";
			$disp_width_max=150;                    // used when displaying watermark choices
			$disp_height_max=80;                    // used when displaying watermark choices
			$edgePadding=20;                        // used when placing the watermark near an edge
			$quality=90;                           // used when generating the final image
		      
			// it was a JPEG or PNG image, so we're OK so far
			
			$original='./gameboard_images/'.$frameimage;
			$target_name=$new_filename;
                       
			$target='./results/'.$target_name;
                        // echo $target;exit;
			$watermark='./watermarks/'.$stamp_image;
			$wmTarget=$watermark.'.tmp';

			$origInfo = getimagesize($original); 
			$origWidth = $origInfo[0];
			$origHeight = $origInfo[1];

			$waterMarkInfo = getimagesize($watermark);
			$waterMarkWidth = $waterMarkInfo[0];
			$waterMarkHeight = $waterMarkInfo[1];
	
			// watermark sizing info
			  $waterMarkDestWidth=round($origWidth * floatval(1));
			 $waterMarkDestHeight=round($origHeight * floatval(1));
		   
			$waterMarkDestWidth-=2*$edgePadding;
			$waterMarkDestHeight-=2*$edgePadding;
					//	 echo "Board".$waterMarkDestWidth."X".$waterMarkDestHeight."<br>"; 		  
			// OK, we have what size we want the watermark to be, time to scale the watermark image
			resize_png_image($watermark,$waterMarkDestWidth,$waterMarkDestHeight,$wmTarget,$type);
			
			// get the size info for this watermark.
			$wmInfo=getimagesize($wmTarget);
			$waterMarkDestWidth=$wmInfo[0];
			$waterMarkDestHeight=$wmInfo[1];

			$differenceX = $origWidth - $waterMarkDestWidth;
			$differenceY = $origHeight - $waterMarkDestHeight;

			// where to place the watermark?
		   
			$placementX =  round($differenceX / 2);
			$placementY =  round($differenceY / 2);
	  
			$resultImage = imagecreatefrompng($original);
			imagealphablending($resultImage, TRUE);
	
			$finalWaterMarkImage = imagecreatefrompng($wmTarget);
			$finalWaterMarkWidth = imagesx($finalWaterMarkImage);
			$finalWaterMarkHeight = imagesy($finalWaterMarkImage);
	
			imagecopy($resultImage,
					  $finalWaterMarkImage,
					  $placementX,
					  $placementY,
					  0,
					  0,
					  $finalWaterMarkWidth,
					  $finalWaterMarkHeight
			);
			
			imagejpeg($resultImage,$target,$quality); 
			imagedestroy($resultImage);
			imagedestroy($finalWaterMarkImage);
		  // display resulting image for download
		  return $target_name;
	}

        function getGameboardWithImage1($stamp_image,$frameimage,$new_filename){
   // echo $stamp_image.'/'.$frameimage.'/'.$new_filename;exit;
                        $type="premium";
			$disp_width_max=150;                    // used when displaying watermark choices
			$disp_height_max=80;                    // used when displaying watermark choices
			$edgePadding=41;                        // used when placing the watermark near an edge
			$quality=100;                           // used when generating the final image

			// it was a JPEG or PNG image, so we're OK so far

			$original='./gameboard_images/'.$frameimage;
			$target_name=$new_filename;

			$target='./results/'.$target_name;
                        // echo $target;exit;
			$watermark='./watermarks/'.$stamp_image;
			$wmTarget=$watermark.'.tmp';
                       
			$origInfo = getimagesize($original);
			$origWidth = $origInfo[0];
			$origHeight = $origInfo[1];
                        
                  //       echo "Frame".$origWidth."X".$origHeight."<br>"; 
                         
			$waterMarkInfo = getimagesize($watermark);
			$waterMarkWidth = $waterMarkInfo[0];
			$waterMarkHeight = $waterMarkInfo[1];
                           
                   //     echo "Image".$waterMarkWidth."X".$waterMarkHeight."<br>"; 
			
// watermark sizing info
			 $waterMarkDestWidth=round($origWidth * floatval(1));
			 $waterMarkDestHeight=round($origHeight * floatval(1));

			$waterMarkDestWidth-=2*$edgePadding;
			$waterMarkDestHeight-=2*$edgePadding;
                        
                    //     echo "Board".$waterMarkDestWidth."X".$waterMarkDestHeight."<br>"; 
			// OK, we have what size we want the watermark to be, time to scale the watermark image
			resize_png_image($watermark,$waterMarkDestWidth,$waterMarkDestHeight,$wmTarget,$type);

			// get the size info for this watermark.
			$wmInfo=getimagesize($wmTarget);
			$waterMarkDestWidth=$wmInfo[0];
			$waterMarkDestHeight=$wmInfo[1];

			$differenceX = $origWidth - $waterMarkDestWidth;
			$differenceY = $origHeight - $waterMarkDestHeight;

			// where to place the watermark?

			$placementX =  round(($differenceX+.50) / 2);
			$placementY =  round($differenceY / 2);

			$resultImage = imagecreatefrompng($original);
			imagealphablending($resultImage, TRUE);

			$finalWaterMarkImage = imagecreatefrompng($wmTarget);
			$finalWaterMarkWidth = imagesx($finalWaterMarkImage);
			$finalWaterMarkHeight = imagesy($finalWaterMarkImage);

			imagecopy($resultImage,
					  $finalWaterMarkImage,
					  $placementX,
					  $placementY,
					  0,
					  0,
					  $finalWaterMarkWidth,
					  $finalWaterMarkHeight
			);

			imagejpeg($resultImage,$target,$quality);
			imagedestroy($resultImage);
			imagedestroy($finalWaterMarkImage);
		  // display resulting image for download
		  return $target_name;
	}


	function resize_png_image($img,$newWidth,$newHeight,$target,$type){
		//echo $img; echo $newWidth.'/'.$newHeight.'/'.$target;exit;
			//$srcImage=imagecreatefrompng('D:\Projects\xampp\htdocs\wannaquiz\watermarks\linkedin2.png');
                       // echo $type;
                        $srcImage=imagecreatefrompng($img);
			if($srcImage==''){
				return FALSE;
			}
			$srcWidth=imagesx($srcImage);
			$srcHeight=imagesy($srcImage);
			$percentage=(double)$newWidth/$srcWidth;
                        if($type=="premium"){
                           $destHeight=round($srcHeight*$percentage)+1;
			   $destWidth=round($srcWidth*$percentage)+10;
                    	  }
                          else {
                           $destHeight=round($srcHeight*$percentage)+1;
			   $destWidth=round($srcWidth*$percentage)-30;
                    	  }
			if($destHeight > $newHeight){
				// if the width produces a height bigger than we want, calculate based on height
				$percentage=(double)$newHeight/$srcHeight;
				if($type="premium"){
                           $destHeight==round($srcHeight*$percentage)+1;
			   $destWidth=round($srcWidth*$percentage)+9;
                    	  }
                          else {
                           $destHeight=round($srcHeight*$percentage)+1;
			   $destWidth=round($srcWidth*$percentage)-30;
                    	  }
                       }
                    //    echo "New de width=".$destWidth."/"."New de heignt: $destHeight"."<br>";
			$destImage=imagecreatetruecolor($destWidth-10,$destHeight-1);
			if(!imagealphablending($destImage,FALSE)){
				return FALSE;
			}
			if(!imagesavealpha($destImage,TRUE)){
				return FALSE;
			}
			if(!imagecopyresampled($destImage,$srcImage,0,0,0,0,$destWidth,$destHeight,$srcWidth,$srcHeight)){
				return FALSE;
			}
			if(!imagepng($destImage,$target)){
				return FALSE;
			}
			imagedestroy($destImage);
			imagedestroy($srcImage);
			return TRUE;
		}
		
		//You do not need to alter these functions
		function getHeight($image) {
			$size = getimagesize($image);
			$height = $size[1];
			return $height;
		}
		//You do not need to alter these functions
		function getWidth($image) {
			$size = getimagesize($image);
			$width = $size[0];
			return $width;
		}


/* End of file image_helper.php */
/* Location: ./application/helpers/image_helper.php */