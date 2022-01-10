<?

  class UPLOADNEW
  {
  	var $directory_name;
  	var $max_filesize;
  	var $error;
  	var $file_name;
  	var $full_name;
  	var $file_size;
  	var $file_type;
  	var $check_file_type;
  	var $thumb_name;
    var $tmp_name;
    
   	function set_directory($dir_name = ".")
  	{
	  	$this->directory_name = $dir_name;
		if(!preg_match('/\/$/',$this->directory_name))
			$this->directory_name.="/";	
  	}

   	function set_max_size($max_file = 3000000)
  	{
  	 $this->max_filesize = $max_file;
  	}
  	
  	function check_for_directory()
  	{
        if (!file_exists($this->directory_name))
        {
           @mkdir($this->directory_name,0777);
        }
        @chmod($this->directory_name,0777);
  	}

   	function error()
  	{
  		if(empty($this->error))
			$this->error='';
	  	 return $this->error;
  	}

  	function set_file_size($file_size)
  	{
  	 $this->file_size = $file_size;
  	}

  	function set_file_type($file_type)
  	{
  	 $this->file_type = $file_type;
  	}
	
  	function get_file_type()
  	{
  	 return $this->file_type;
  	}

  	function set_temp_name($temp_name)
  	{
  	 $this->tmp_name = $temp_name;
  	}

   	function set_file_name($file)
  	{
  		$this->file_name = preg_replace("/[\s'\"\t]*/",'',stripslashes($file));
  		$this->full_name = $this->directory_name.$this->file_name;
  	}

  	function resize($max_width = 0, $max_height = 0 )
  	{
      	if(eregi("\.png$",$this->full_name))
      	{
      	 $img = ImageCreateFromPNG ($this->full_name);
      	}

      	if(eregi("\.(jpg|jpeg)$",$this->full_name))
      	{
      	 $img = ImageCreateFromJPEG ($this->full_name);
      	}

      	if(eregi("\.gif$",$this->full_name))
      	{
      	 $img = ImageCreateFromGif ($this->full_name);
      	}

      	$FullImage_width = imagesx ($img);
      	$FullImage_height = imagesy ($img);

    		if(isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0)
    		{
    		 $new_width = $max_width;
    		 $new_height = $max_height;
    		}
    		else if(isset($max_width) && $max_width != 0)
    		{
    		 $new_width = $max_width;
    		 $new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
    		}
    		else if(isset($max_height) && $max_height != 0)
    		{
    		 $new_height = $max_height;
    		 $new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
    		}
    		else
    		{
    		 $new_height = $FullImage_height;
    		 $new_width = $FullImage_width;
    		}

       	$full_id =  ImageCreateTrueColor ( $new_width , $new_height );
    		ImageCopyResampled ( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );


    		if(eregi("\.(jpg|jpeg)$",$this->full_name))
    		{
    		 $full = ImageJPEG( $full_id, $this->full_name,100);
    		}

    		if(eregi("\.png$",$this->full_name))
    		{
    		 $full = ImagePNG( $full_id, $this->full_name);
    		}

    		if(eregi("\.gif$",$this->full_name))
    		{
    		 $full = ImageGIF($full_id, $this->full_name);
    		}
    		ImageDestroy( $full_id );
    		unset($max_width);
    		unset($max_height);
  	}

  	function set_thumbnail_name($thumbname)
  	{
    	if(eregi("\.png$",$this->full_name))
    	 $this->thumb_name = $this->directory_name.$thumbname.".png";
    	if(eregi("\.(jpg|jpeg)$",$this->full_name))
    	 $this->thumb_name = $this->directory_name.$thumbname.".jpg";
    	if(eregi("\.gif$",$this->full_name))
    	 $this->thumb_name = $this->directory_name.$thumbname.".gif";
  	}

  	function create_thumbnail()
  	{
    	 if (!copy($this->full_name, $this->thumb_name))
    	  {
       	  echo "<br>".$this->full_name.", ".$this->thumb_name."<br>";
    	    echo "failed to copy $file...<br />\n";
    	  }
  	}

  	function set_thumbnail_size($max_width = 0, $max_height = 0 )
  	{
      	if(eregi("\.png$",$this->thumb_name))
      	{
      	 $img = ImageCreateFromPNG ($this->thumb_name);
      	}

      	if(eregi("\.(jpg|jpeg)$",$this->thumb_name))
      	{
      	 $img = ImageCreateFromJPEG ($this->thumb_name);
      	}

      	if(eregi("\.gif$",$this->thumb_name))
      	{
      	 $img = ImageCreateFromGif ($this->thumb_name);
      	}

      	$FullImage_width = imagesx ($img);
      	$FullImage_height = imagesy ($img);

    		if(isset($max_width) && isset($max_height) && $max_width != 0 && $max_height != 0)
    		{
    		 $new_width = $max_width;
    		 $new_height = $max_height;
    		}
    		else if(isset($max_width) && $max_width != 0)
    		{
    		 $new_width = $max_width;
    		 $new_height = ((int)($new_width * $FullImage_height) / $FullImage_width);
    		}
    		else if(isset($max_height) && $max_height != 0)
    		{
    		 $new_height = $max_height;
    		 $new_width = ((int)($new_height * $FullImage_width) / $FullImage_height);
    		}
    		else
    		{
    		 $new_height = $FullImage_height;
    		 $new_width = $FullImage_width;
    		}
        	$full_id =  ImageCreateTrueColor ( $new_width , $new_height );
    		ImageCopyResampled ( $full_id, $img, 0,0,0,0, $new_width, $new_height, $FullImage_width, $FullImage_height );


    		if(eregi("\.(jpg|jpeg)$",$this->thumb_name))
    		{
    		 $full = ImageJPEG( $full_id, $this->thumb_name,100);
    		}

    		if(eregi("\.png$",$this->thumb_name))
    		{
    		 $full = ImagePNG( $full_id, $this->thumb_name);
    		}

    		if(eregi("\.gif$",$this->thumb_name))
    		{
    		 $full = ImageGIF($full_id, $this->thumb_name);
    		}
    		ImageDestroy( $full_id );
    		unset($max_width);
    		unset($max_height);
  	}
  	
    function upload_file($uploaddir,$name,$rename=null,$replace=false,$file_max_size=0,$check_type=null)
    {
        $this->set_file_type($_FILES[$name]['type']);
        $this->set_file_size($_FILES[$name]['size']);
        $this->error=$_FILES[$name]['error'];
        $this->set_temp_name($_FILES[$name]['tmp_name']);
        $this->set_max_size($file_max_size);

		$this->set_directory($uploaddir);
        $this->check_for_directory();
        $this->set_file_name($_FILES[$name]['name']);

		if(!is_uploaded_file($this->tmp_name))
		 $this->error = "File ".$this->tmp_name." is not uploaded correctly.";

		if(empty($this->file_name))
		 $this->error = "File is not uploaded correctly.";
		if($this->error!="")
          return false;

		if(is_bool($check_type) && $check_type==true)
			$check_type='gif|jpg|jpeg|tiff';
		
		if(!empty($check_type))
        {
		   if(!eregi("\.($check_type)$",$this->file_name))
		   {
           	 $this->error="File type error : Not a valid file";
			 return false;
			}
        }

		if(!is_bool($rename)&&!empty($rename))
		{
			if(preg_match("/\..*+$/i",$this->file_name,$matches))
			   $this->set_file_name($rename.$matches[0]);
		}
		elseif($rename && file_exists($this->full_name))
		{
			if(preg_match("/\..*+$/i",$this->file_name,$matches))
			   $this->set_file_name(substr_replace($this->file_name,"_".time(),-strlen($matches[0]),0));
		}

		if(file_exists($this->full_name))
        {
          if($replace)
            @unlink($this->full_name);
          else
		  {
           	 $this->error="File error : File already exists";
			 return false;
		  }
        }

		
        $this->start_upload();
        if($this->error!="")
          return false;
        else
          return $this->file_name;
    }

  	function start_upload()
  	{
  		if(!isset($this->file_name))
  		 $this->error = "You must define filename!";

      if ($this->file_size <= 0)
  		 $this->error = "File size error (0): $this->file_size Bytes<br>";

      if ($this->file_size > $this->max_filesize && $this->max_filesize!=0)
  		 $this->error = "File size error (1): $this->file_size Bytes<br>";

       if ($this->error=="")
       {
			$destination=$this->full_name;
  			if (!@move_uploaded_file ($this->tmp_name,$destination))
  			 $this->error = "Impossible to copy ".$this->file_name." from $userfile to destination directory.";
			else
				@chmod($destination,0777);
  		}
  	}
	
//================================================================	
	
	/*function resizeImage($dest,$source,$modWidth,$modeHeight,$filype)
	{
		if(!empty($source) && !empty($dest))
		{
			list($width,$height) = getimagesize($source);
			$modWidth            = $modWidth;
			$modHeight           = $modeHeight; 
			$ictc                = imagecreatetruecolor($modWidth,$modHeight);
			if(basename($_FILES[$filype]['type'])=="jpg" || basename($_FILES[$filype]['type'])=="jpeg")
			{
				$img                 = imagecreatefromjpeg($source);
				imagecopyresampled($ictc, $img, 0, 0, 0, 0, $modWidth, $modHeight,$width,$height);
				imagejpeg($ictc, $dest, 100);
			}
			if(basename($_FILES[$filype]['type'])=="gif")
			{
				$img                 = imagecreatefromgif($source);
				imagecopyresampled($ictc, $img, 0, 0, 0, 0, $modWidth, $modHeight,$width,$height);
				imagegif($ictc, $dest, 100);
			}
			if(basename($_FILES[$filype]['type'])=="png")
			{
				$img                 = imagecreatefrompng($source);
				imagecopyresampled($ictc, $img, 0, 0, 0, 0, $modWidth, $modHeight,$width,$height);
				imagepng($ictc, $dest, 100);
			}
		}
	}*/
	
//================================================================

function resizeImage($dest,$source,$modWidth,$modeHeight,$filype)
    {
        if(!empty($source) && !empty($dest))
        {
            //============================================
           
           
            $size = getimagesize($source);
            $iWidth = $size['0'];
            $iHeight = $size['1'];
           
            $imageWidth = $modWidth;
            $imageHeight = $modeHeight;
           
            if($imageWidth!=0 && $imageHeight==0){
                                           
                    $reWidth = $imageWidth;
                    $reHeight = ceil($iHeight*$imageWidth/$iWidth);
               
            } elseif($imageWidth==0 && $imageHeight!=0){
               
                    $reHeight = $imageHeight;
                    $reWidth = ceil($iWidth*$imageHeight/$iHeight);
               
            } elseif($imageWidth!=0 && $imageHeight!=0){
                $reWidth = $imageWidth;
                $reHeight = $imageHeight;
            } else {
                $reWidth = $iWidth;
                $reHeight = $iHeight;
            }
           
           
            //============================================
            list($width,$height) = getimagesize($source);
            $modWidth            = $reWidth;
            $modHeight           = $reHeight;
            $ictc                = imagecreatetruecolor($modWidth,$modHeight);
            if(basename($_FILES[$filype]['type'])=="jpg" || basename($_FILES[$filype]['type'])=="jpeg")
            {
                $img                 = imagecreatefromjpeg($source);
                imagecopyresampled($ictc, $img, 0, 0, 0, 0, $modWidth, $modHeight,$width,$height);
                imagejpeg($ictc, $dest, 100);
            }
            if(basename($_FILES[$filype]['type'])=="gif")
            {
                $img                 = imagecreatefromgif($source);
                imagecopyresampled($ictc, $img, 0, 0, 0, 0, $modWidth, $modHeight,$width,$height);
                imagegif($ictc, $dest, 100);
            }
            if(basename($_FILES[$filype]['type'])=="png")
            {
				$img                 = imagecreatefrompng($source);
                imagecopyresampled($ictc, $img, 0, 0, 0, 0, $modWidth, $modHeight,$width,$height);
                imagepng($ictc, $dest, 9);

            }
        }
    }

//================================================================	

  }
?>