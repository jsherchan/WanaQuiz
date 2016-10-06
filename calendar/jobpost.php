<link rel="stylesheet" type="text/css" href="calendar.css">
<link href="style.css" rel="stylesheet" type="text/css" />

    <?
$jobs_id=$_POST['id'];
if(!isset($_SESSION['userid'])){
echo "<script>document.location='member.php?act=signin&error=2&back_page=".base64_encode("job.php?act=jobpost")."';</script>";
}	$Objjobrange=new jobrange('');
	$range=$Objjobrange->get_all();


?>
 
	
<script type="text/javascript" src="calendar.js"></script>
<script type="text/javascript" src="calendar-en.js"></script>
<script type="text/javascript" src="calendar-setup.js"></script>

 <script type="text/javascript">
   var creationDate = new Date();
	  
	  function checkDates(d1,d2){
	       var valid = true;
		   var dd1 = new Date(d1);
		   var dd2 = new Date(d2);
		  if(d1=='' || d2=='' || dd1=='NaN'|| dd2=='NaN' || dd1=='Invalid Date'|| dd2=='Invalid Date')
				         valid = false;
						 if (dd2.getTime()-dd1.getTime() < 1800000)
						          valid = false;
								       if (dd1.getTime()-creationDate.getTime() < 172800000)
						          valid = false;
								       if (!valid)
									    alert('Your start time slot cannot be within the next 48 hours. Also check to ensure your ending time slot is at least 30 minutes duration.');
										return valid;
					} 
	
 
 function bid_display(type)
 {
	if(type=='online'){
		 document.getElementById('disp_online').style.display='block';
		 document.getElementById('disp_onsite').style.display='none';
	}if(type=='onsite'){
		
		   document.getElementById('disp_online').style.display='none';
		 document.getElementById('disp_onsite').style.display='block';
	}
	
 }
 //function to get detail of the time slot
 function add_slot()
  {
   var xmlHttp1;
   var st_time=document.getElementById('starttime').value;
   var ed_time=document.getElementById('endtime').value;
 	test=checkDates(st_time,ed_time);
	if(test==true){
   try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp1=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp1=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
    xmlHttp1.onreadystatechange=function()
      {
      if(xmlHttp1.readyState==4)
        {
		str = xmlHttp1.responseText;
	    document.getElementById('time_slot').innerHTML = str;
   		 	
        }
      }
	 
	  xmlHttp1.open("GET", "time_slot.php?st_time=" +st_time+"&ed_time="+ed_time, true);
	  xmlHttp1.send(null);
	  }
  }
 
 function fileupload_value(number)
  {
   var xmlHttp1;
   try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp1=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp1=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
    xmlHttp1.onreadystatechange=function()
      {
      if(xmlHttp1.readyState==4)
        {
		str = xmlHttp1.responseText;
		
	    document.getElementById('fileupload').innerHTML = str;
   		 	
        }
      }
	 
	  xmlHttp1.open("GET", "ajax_fileupload.php?number=" +number, true);
	  xmlHttp1.send(null);
  }
 </script>

 <script type="text/javascript">
function getsubcategory(id)
  {
   var xmlHttp;
  var places = new Array();
  var str="";
  places="";
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
    xmlHttp.onreadystatechange=function()
      {
      if(xmlHttp.readyState==4)
        {
		places.length=0;
		
		str = xmlHttp.responseText;
			// sets state  option value to null,
		//document.forms['form1'].state.options[0]=null;
	     //Equivalent code is shown below		
			 var o = document.forms['jobpost'].subcategory_id.options;
          if ((o.length = 0) > 0)
          {
         while (o.length > 0)
          {
        o[0] = null;
          }
          }
		 places = str.split("@");
		for(i=0; i<places.length; i++) {
		        places1=0;
		        places1=places[i].split("#");
				document.forms['jobpost'].subcategory_id.options[i]=new Option(places1[0],places1[1]);
		}
        }
      }
	 xmlHttp.open("GET", "ajax_subcategory.php?pid=" +id, true);
	
    xmlHttp.send(null);
  }
  
</script>

<? 
	if(count($_SESSION['time'])>0){
	for($i=$delid+1;$i<sizeof($_SESSION['time']);$i++)
	{
		$_SESSION['time'][$i-1]=$_SESSION['time'][$i];
	}
	array_pop($_SESSION['time']);
}

	$Objstate=new countries('state' ,'');
$state=$Objstate->all();
?>
<link href="../style.css" rel="stylesheet" type="text/css" />
<br>


<td valign="top">
<form action="job.php?act=viewproject" method="post" enctype="multipart/form-data" name="jobpost" id="form1" onSubmit="return isRequired(this);">
<TABLE width="568"  border=0 align="left" cellPadding=0 cellSpacing=0>
    <!--<TR>
    <TD><IMG height=12 src="images/spacer.gif" width=1></TD>
    </TR>-->
      <TR>
        <TD vAlign=top><table cellspacing=0 cellpadding=0 width="568" border=0>
          <tr >
              <td height="30" colspan="2" bgcolor="#dae2e3"><p class=orange_text> &nbsp;&nbsp;<img src="images/blue_red_arrow.gif" width="5" height="14" />&nbsp;&nbsp;Post
                  your job </p></td>
           </tr>
           <tr>
             <td colspan="2" valign="top" bgcolor="#f5f8f8">&nbsp;<span class="title2"><br />
                </span>
                <table width="100%"  >
                  <tr>
                    <td align="left" valign="top"><div  class="lightblue"><span class="title2"></span><span class="orange_text">Job Title</span> Please
                        describe a name with several words that will identify
                        the type of job to be done.Examples:<br />
                        Ex: 
                        &nbsp;<strong>Landscape
                        my garden with 100 square metrs</strong> Good title is important
                        because Professionals &nbsp;find listings. </div>					</td>
                  </tr>
                </table>
                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                    <td width="31%"><div align="left"><span class="orange_text">Job
                      Title:</span> <span class="style9">*</span></div></td>
                    <td width="69%" class="title2">
                      <input type="text" size="35" name="jobs_title" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2"><span class="title2" ><br />
                    </span>
                      <table width="100%" align="center">
                  		<tr>
                   		 <td colspan="2" align="left"><div class="lightblue">
                   		   <div align="left"><span class="title2" >
                   		     &nbsp;</span><span class="orange_text">Location:</span> Location specifies where your
                   		     job/s needs to be done so as to maximize responses to
                   		     your advertisement locally. Note: Defaults to your home
                   		     location you filled in originally, hence change if different</div>
                   		 </div></td>
                  		</tr>
				 	 <tr>
				   <td colspan="2">&nbsp;</td>
				  </tr>
				  <tr>
				   <td width="32%" align="left"><span class="orange_text">Suburbs</span><span class="style9">*</span></td>
				   <td width="68%"><input type="text"  name="suburbs" /></td>
				  </tr>
				  <tr>
				   <td><span class="orange_text">State:</span><span class="style9">*</span></td>
				   <td>
				   <select name="state">
                         <option>Select State </option>
                         <? for ($i=0;$i<sizeof($state);$i++)
						{?>
                         <option value="<? echo $state[$i]['id']; ?>"><? echo $state[$i]['name'];?>
						 </option>
                             <? } ?>
                         </select>
				   </td>
				  </tr>
				  <tr>
				   <td><span class="orange_text">Post Code:</span><span class="style9">*</span></td>
				   <td><input type="text" size="10" name="postcode" /></td>
				  </tr>
                </table>              </td>
            </tr>
			</table>
			  <div align="center"  class="lightblue"><span class="orange_text" >
                      &nbsp;Description: </span>Describe your Job/works
                              to be carried out on comprehensively to inform
                              Professionals and answer most of their questions.
                              The more detail, the better. Specify any Terms/Conditions
                              or any policies you wish to mention. Ex : Asbestos
                              presence or OH&S concerns, etc Note: For security
                              reasons don't reveal your personnel details including
                              any form of contact details here at this stage.
                              Once the Job is posted you will not be able to
                              edit Title, description, however you can post additional
                              messages you wish for others to view</div>
			<table width="72%" border="0" cellpadding="0" cellspacing="4">
              <tr>
                <td width="46%" align="left"><span class="orange_text">Description:</span><span  			 			  class="style9">*</span></td>
                <td  width="54%"><textarea name="description" rows="5"></textarea></td>
              </tr>
              <tr>
                <td><span class="orange_text">Bidding Start  Date</span><span class="style9">*</span> </td>
                <td>
				<input name="startdate" id="startdate" value="" type="text">
				
				<img src="images/calendar.gif" width="16" height="15" align="absmiddle" id="calendarImage" style="cursor: pointer;">
				</td>
              </tr>
              <tr>
                <td><span class="orange_text">Bidding End Date:</span><span class="style9">*</span></td>
                <td>
				<input name="enddate" id="enddate" value="" type="text">&nbsp;<img src="images/calendar.gif" width="16" height="15" align="absmiddle" id="calendarImage3" style="cursor: pointer;">
				</td>
              </tr>
              <tr>
                <td><span class="orange_text">Number of Bids Required:</span><span class="style9">*</span></td>
                <td><input type="text"  name="no_of_bids" /></td>
              </tr>
			  <tr>
                <td><span class="orange_text">Project Range:</span><span class="style9">*</span></td>
                <td><select name='range' class='normal'>
  <? foreach($range as $k=>$v){?><option value=<?=$v['jobrangeid'];?>><?=$v['range'];?></option><? }?>
</select></td>
              </tr>
              
            </table>
			<div class="lightblue"><span class="title2" >
                      </span><span class="orange_text">Bidding  types :</span><span> you
                        have two options for Professionals to quote. You have
                        to pick any one of the types.</span></div>
			<table width="568%" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td>
			<input name="bidding_type" type="radio" value="onsite" onclick="bid_display('onsite')" />	<span class="orange_text">Onsite   Bidding</span></td>
              </tr>
              <tr>
                <td>
				<input name="bidding_type" type="radio" value="online" onclick="bid_display('online')"/><span class="style9">Off Site Bidding or Online Bidding </span></td>
              </tr>
			  <tr>
			  <td colspan="3">
                     <div id="time_slot"><br>

                               <?
				 if(count($_SESSION['time'])>0){
				 foreach($_SESSION['time'] as $key=>$val)
{
	echo "Start Time : ".$val['start_time']." End Time:".$val['end_time'];?>
                               [<a href="job.php?act=jobpost&del_id=<?=$key;?>">Remove</a>]<br>
                               <? }
}
?><br>

                    </div>
                           <div id="bid_div" >
						   <div id="disp_online" style="display:none">
						   <div class="lightblue">Based on the information you have provided that you feel is sufficient, all the Professionals will bid for your job online. Pl use this type to save time.<br>
</div> <br>
</div>
						  <div id="disp_onsite" style="display:none">
						 <div class="lightblue">
						 The Professional/s will visit the job site during the specified time slots (you will need to specify various time slots that Professional/s can visit for the Job inspection.You can choose up to 6 number of slots.</div>	
						 <br> 
                         <span class="orange_text">Start Time:</span><span class="neww">
					     &nbsp;&nbsp;
				        <input type="text" name="starttime" id="starttime" class="onsite">
						  <img src="images/calendar.gif" width="16" height="15" align="absmiddle" id="calendarImage1" style="cursor: pointer;">
						  <br>
                          <br>
						  </span><span class="orange_text">End Time</span><span class="neww">:
						 &nbsp;&nbsp;
						 <input type="text" id="endtime" name="endtime" class="onsite">
						  <img src="images/calendar.gif" width="16" height="15" align="absmiddle" id="calendarImage2" style="cursor: pointer;">
						  <br>
						  <input type="button" id="addslot" value="Add slot" onClick="add_slot()" >
						 </span>						  </div>
						  <br>
						   
						  
						   </div></td>
			  </tr>
            </table>
			<span class="title2">Category: </span><br />
<div class="lightblue"><span class="title2" >
                      </span><span class="orange_text">Catagory :</span><span> you
                        have two options for Professionals to quote. You have
                        to pick any one of the types.</span></div>

						<br />
						<span class="title2">Sub Category</span><br />
 						<div  class="lightblue"><span class="title2" >
                      &nbsp;</span><span class="orange_text">Sub Categories:</span> Select the sub 			 						category or multiple sub categories
          that best describes your Job so that most Professionals will find it
          under Category search

			Note: For better search results, enter more specific words Ex:, Say a search
          for Plumber will give all jobs posted on this sub category When a Professional
          searches for Jobs that match their skills, your Job will be displayed
          to them. </div>

<br />
<table width="353"  border="0" cellpadding="0" cellspacing="4">
  <tr>
    <td width="59%"><span class="orange_text">Category </span><span class="orange_text">:</span><span class="style9">*</span></td>
	         		 <?
					 $cat['id']=0;
					 $Objcategories=new categories($cat); 
					 $data=$Objcategories->get_sub_categories(); 
					 ?>
    <td width="41%">
	<select name="category_id" onchange="getsubcategory(this.value);">
    <option>Select Category</option>
    <? for($i=0;$i<sizeof($data);$i++){?>
       <option value="<? echo $data[$i]['id'];?>"><? echo $data[$i]['name'];?> </option>
    <? }?>
    </select>
	</td>
  </tr>
  <tr>
    <td><span class="orange_text"> Sub - Category </span><span class="orange_text">:</span><span class="style9">*</span></td>
    <td>
	<select name="subcategory_id">
    <option>Select Sub Category</option>
    </select>
	</td>
  </tr>
  </table>
  <!--<table width="100%">
  <tr>
  <td width="100%"><div class="lightblue"> &nbsp;</span><span class="orange_text">Estimated Cost:</span> You can specify the cost range as well it is an optional </div></td>
  </tr>
  </table>
  <table>
	<tr class="neww">
	<td> <span class="orange_text">Estimated cost of project:</span> </td>
	<td colspan="2"><input name="cost" type="text"/></td>
	</tr>
</table>-->
<span class="black_bold"><br>
You can upload multiple files and up to 5 photos of your special Job 
Note: Pictures are better than 1000 words</span><br />
<table width="62%"  border="0" cellpadding="0" cellspacing="4">
  <tr>
    <td width="60%" class="orange_text">Number of Files to upload</td>
    <td width="40%">
	<select name="uploadnum" onchange="fileupload_value(this.value)">
                                   <option value=''>Select one</option>
                                   <option value='1'>1</option>
                                   <option value='2'>2</option>
                                   <option value='3'>3</option>
                                   <option value='4'>4</option>
                                   <option value='5'>5</option>
                               </select>
	</td>
  </tr>
</table>
             <table width="350"  border="0" cellpadding="0" cellspacing="4">
			 	<tr>
				 <td>
				 <div id='fileupload'>&nbsp;</div>
				 </td>
				</tr>
               <tr>
                 <td width="61%"><input type="submit" name="Submit" value="save for latest work" />
				
				 </td><td width="39%"><input type="submit" name="Submit2" value="Preview Project" /></td>
               </tr>
             </table>
           </table></table>
		   </form>
		   </td>
		  
 
<script type="text/javascript">
      Calendar.setup(
        {
          inputField  : "startdate",        // ID of the input field
          ifFormat    : "%B %d, %Y",        // the date format
          button      : "calendarImage"           // ID of the button
        }
      ); 
	 
	 Calendar.setup(
        {
          inputField  : "enddate",        // ID of the input field
          ifFormat    : "%B %d, %Y",        // the date format
          button      : "calendarImage3"           // ID of the button
        }
      );
      
   Calendar.setup(
        {
          inputField  : "starttime",        // ID of the input field
          ifFormat    : "%B %d, %Y %H:%M",  // the date format
          button      : "calendarImage1",   // ID of the button
          showsTime   : "true"  
        }
      );      
         
      Calendar.setup(
        {
          inputField  : "endtime",          // ID of the input field
          ifFormat    : "%B %d, %Y %H:%M",  // the date format
          button      : "calendarImage2",   // ID of the button
          showsTime   : "true"
        }
      );      
      
     
    </script>	
	
	
<script language="JavaScript">

function isRequired(theFrm){
		var validate = true;
		if(theFrm.jobs_title.value.length == 0){
			alert('Job title is required field.Please fill it in');
			document.jobpost.jobs_title.focus();
			validate = false;
			return false;
		}
		if(theFrm.suburbs.value.length == 0){
			alert('Suburbs field is required field.Please fill it in');
			document.jobpost.suburbs.focus();
			validate = false;
			return false;
		}
		if(theFrm.state.value == 'Select State'){
			alert('State is required option, please fill it.');
			document.jobpost.state.focus();
			validate = false;
			return false;
		}
		if(theFrm.postcode.value == 0){
			alert('Please fill postal code, it is required field.');
			document.jobpost.postcode.focus();
			validate = false;
			return false;
		}
			 if(isNaN(theFrm.postcode.value))
		{
		alert("Invalid Postal code.");
			document.jobpost.postcode.focus();
						validate = false;

			return false;
		}
		if(theFrm.description.value == 0){
			alert('Description is required field, Please fill it.');
			document.jobpost.description.focus();

			validate = false;
			return false;
		}
		if(theFrm.startdate.value == 0){
			alert('Please choose the starting date from calender.');
			document.jobpost.startdate.focus();

			validate = false;
			return false;
		}if(theFrm.enddate.value == ''){
			alert('Please choose the ending date from calender.');
			validate = false;
			return false;
		}
		else if((document.getElementById("startdate").value!='')&&(document.getElementById("enddate").value!='')){
		   var dd1 = new Date(document.getElementById("startdate").value);
		   var dd2 = new Date(document.getElementById("enddate").value);
 
		 	if (dd2.getTime()<dd1.getTime()){		
			    alert('End Date smaller than start date.');
				validate = false;	
				return false;}
		 
	}
	if(theFrm.no_of_bids.value == 0){
			alert('Please enter number of bids.');
			validate = false;
			return false;
		}
//
		
		
			if(isNaN(theFrm.no_of_bids.value))
		{
		alert("Invalid Number code.");
			document.jobpost.no_of_bids.focus();
			validate = false;
			return false;
		}
		 if(theFrm.category_id.value == "Select Category"){
			alert('Please choose one category.');
			document.jobpost.category_id.focus();
			validate = false;
			return false;
		}	if(theFrm.subcategory_id.value == "Select Sub Category"){
			alert('Please choose one Sub Category.');
			document.jobpost.subcategory_id.focus();

			validate = false;
			return false;
		}
		
		if(theFrm.bidding_type.length>0){
		checked=false;

	
	for(i=0;i<theFrm.bidding_type.length;i++){
		if(theFrm.bidding_type[i].checked==true){
			checked=true;
		}}
		if(checked==false){
			alert('Please select one bidding type');
			validate=false;
			return false;
		}
	
		
	}	


	
	}
	</script>



