<?php



     class Page
     {
      var $total_records=1;
      var $records_per_page=1;
      var $page_name="";
      var $start=0;
      var $page=0;
      var $total_page=0;
      var $current_page;
      var $remain_page;
      var $show_prev_next=true;
      var $show_scroll_prev_next=false;
      var $show_first_last=false;
      var $scroll_page=0;
	  var $qry_str="";
	  var $link_para="";

      function is_last_page()
      {
       return $this->page>=$this->total_page-1?true:false;
      }
      function is_first_page()
      {
       return $this->page==0?true:false;
      }
      function current_page()
      {
       return $this->page+1;
      }
      function total_page()
      {
       return $this->total_page==0?1:$this->total_page;
      }
	  function set_link_parameter($link_para)
	  {
	  	$this->link_para=$link_para;
	  }
      function set_page_name($page_name)
      {
       $this->page_name=$page_name;
      }
      function set_qry_string($str="")
      {
       $this->qry_str="&".$str;
      }
      function set_scroll_page($scroll_num=0)
      {
        $this->scroll_page=$scroll_num;
        if($scroll_num<0)
            $scroll_num=0;

       if($scroll_num==0 || ($scroll_num > $this->total_page && $this->total_page!=0 ))
          $this->scroll_page=$this->total_page;
      }
      function set_total_records($total_records)
      {
       if($total_records<0)
          $total_records=0;
       $this->total_records=$total_records;
      }
      function set_records_per_page($records_per_page)
      {
         if($records_per_page<0)
              $records_per_page=0;
         $this->records_per_page=$records_per_page;
      }
      function set_page_data($page_name,$total_records,$records_per_page=1,$scroll_num=0,$show_prev_next=true,$show_scroll_prev_next=false,$show_first_last=false)
      {
       //$scroll_num=100000000;
       $this->set_records_per_page($records_per_page);
       $this->set_total_records($total_records);
       $this->set_scroll_page($scroll_num);
       $this->set_page_name($page_name);
       $this->show_prev_next=$show_prev_next;
       $this->show_scroll_prev_next=$show_scroll_prev_next;
       $this->show_first_last=$show_first_last;
      }
     /* function get_first_page_nav($user_link="",$link_para="")
      {
	  	if(trim($user_link)=="")
			$user_link="[First]";
        if(!$this->is_first_page()&& $this->show_first_last)
            echo ' <a href="'.$this->page_name.'?page=0'.$this->qry_str.'" '.$link_para.'>'.$user_link.'</a> ';
      }
      function get_last_page_nav($user_link="",$link_para="")
      {
	  	if(trim($user_link)=="")
			$user_link="[Last]";
        if(!$this->is_last_page()&& $this->show_first_last)
            echo ' <a href="'.$this->page_name.'?page='.($this->total_page-1).$this->qry_str.'" '.$link_para.'>'.$user_link.'</a> ';
      }*/
      function get_next_page_nav($user_link="",$link_para="")
      {
	  	if(trim($user_link)=="")
			$user_link=" Next";
        if(!$this->is_last_page()&& $this->show_prev_next)
            echo ' <a href="'.$this->page_name.'?page='.($this->page+1).$this->qry_str.'" '.$link_para.' class="paging">'.$user_link.'</a> ';
        elseif($this->show_prev_next)
            echo $user_link;
      }
      function get_prev_page_nav($user_link="",$link_para="")
      {
	  	if(trim($user_link)=="")
			$user_link="Prev";
        if(!$this->is_first_page()&& $this->show_prev_next)
            echo ' <a href="'.$this->page_name.'?page='.($this->page-1).$this->qry_str.'" '.$link_para.' class="paging">'.$user_link.'</a> ';
        elseif($this->show_prev_next)
            echo $user_link;
      }
      function get_scroll_prev_page_nav($user_link="",$link_para="")
      {
	  	if(trim($user_link)=="")
			$user_link="Prev[$this->scroll_page]";
        if($this->page>$this->scroll_page &&$this->show_scroll_prev_next)
            echo ' <a href="'.$this->page_name.'?page='.($this->page-$this->scroll_page).$this->qry_str.'" '.$link_para.'>'.$user_link.'</a> ';
      }
      function get_scroll_next_page_nav($user_link="",$link_para="")
      {
	  	if(trim($user_link)=="")
			$user_link="Next[$this->scroll_page]";
        if($this->total_page>$this->page+$this->scroll_page &&$this->show_scroll_prev_next)
            echo ' <a href="'.$this->page_name.'?page='.($this->page+$this->scroll_page).$this->qry_str.'" '.$link_para.'>'.$user_link.'</a> ';
      }

      function get_number_page_nav($link_para="")
      {
        $j=0;
        if($this->page>($this->scroll_page/2))
          $j=$this->page-intval(($this->scroll_page/2));
        if($j+$this->scroll_page>$this->total_page)
          $j=$this->total_page-$this->scroll_page;
        if($j<0)
        {
          $j=0;
          $this->scroll_page=1;
        }
        if($this->scroll_page==$this->total_records)
          $j=0;
        for($i=$j;$i<$j+$this->scroll_page && $i<$this->total_records;$i++)
        {
         if($i==$this->page)
            echo '&nbsp;'.($i+1);
         else
            echo ' <a href="'.$this->page_name.'?page='.$i.$this->qry_str.'" '.$link_para.' class="paging">'.($i+1).'</a> ';
        }
      }

      function get_page_nav()
      {
	  	if($this->total_records<=0)
		{
			echo "No Records Found";
			return;
		}
        $this->calculate();
        //$this->get_first_page_nav("",$this->link_para);
        $this->get_scroll_prev_page_nav("",$this->link_para);
        $this->get_prev_page_nav("",$this->link_para);
        $this->get_number_page_nav($this->link_para);
        $this->get_next_page_nav("",$this->link_para);
        $this->get_scroll_next_page_nav("",$this->link_para);
       // $this->get_last_page_nav("",$this->link_para);

      }
      function calculate()
      {
        $this->page=$_REQUEST['page'];
        if(!is_numeric($this->page))
          $this->page=0;
        $this->start=$this->page*$this->records_per_page;
        $this->total_page=intval($this->total_records/$this->records_per_page);
        if($this->total_records%$this->records_per_page!=0)
          $this->total_page++;
        $this->set_scroll_page($this->scroll_page);
      }
      function get_limit_query($qry="")
      {
        $this->calculate();
        return $qry." LIMIT $this->start,$this->records_per_page";
      }
	  
	  
	  
	  //////////////////////////////////////////////////////////////////////////////////////////////
	 function getFileList($dir) { 
	
	  $retval = array(); 
	   if(substr($dir, -1) != "/") $dir .= "/"; 
	    $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
		 while(false !== ($entry = $d->read())) { 
		 if($entry[0] == ".") continue;
		  if(is_dir("$dir$entry")) {
		    $retval[] = array( 
		   	"name" => "$dir$entry/",
			"type" => filetype("$dir$entry"), 
			"size" => 0, 
			"lastmod" => filemtime("$dir$entry") 
			); 
			} elseif(is_readable("$dir$entry")) { 
				$retval[] = array( 
					"name" => "$dir$entry", 
					"type" => mime_content_type("$dir$entry"), 
					"size" => filesize("$dir$entry"), 
					"lastmod" => filemtime("$dir$entry") 
					); 
					} 
					} 
					$d->close(); 
					return $retval; 
		}
	 
	 function readFileContents($filePath) { 
		
		$file = fopen("$filePath", "r") or exit("Unable to open file!");
		
			while(!feof($file))
			{
				$disContent.= fgets($file);
			}
	  		return $disContent; 
		}
	 ////////////////////////////////////////////////////////////////////////////////////////////////
	  
	  
	  
}


     /* Example 1
        $page=new Page();
        $page->set_total_records($total_records); //number of Total records
        $page->set_records_per_page(1); //number of records displays on a single page
        //$page->show_prev_next=false; //Shows Previous and Next Page links
        $page->show_scroll_prev_next=true; //Shows Previous and Next Page links
        $page->show_first_last=true; //Shows first and Last Page links
        $page->set_page_name('dsays2.php'); //set the page name on which paging has to be doen

        echo $qry=$page->get_limit_query($qry); //return the query with limits
        echo "<br>";
        $db->query($qry);
        while($row=$db->fetchObject())
        {
        echo $row->username."<br>";
        }
        $page->get_page_nav(); // Shows the nevigation bars;
     */

     /* Example 2
       $page=new Page();
       $page->set_page_data('dsays2.php',$total_records,7,0,false,false,true);

     */
	 
	 
?>
