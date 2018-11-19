<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>

	  <title>jQuery Easy Accordion Plugin</title>

	  

      <!-- Meta -->

      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

	  <meta name="author" content="Andrea Cima Serniotti - Madeincima.it" />

	  <meta name="description" content="jQuery Easy Accordion Plugin - A highly flexible timed horizontal slider able to show any kind of content" />

	  <meta name="keywords" content="jQuery, plugin, accordion, slider, slideshow, horizontal, timed, interval" />	  

      

      <!-- Scripts -->

      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

	  <script type="text/javascript" src="scripts/jquery.easyAccordion.js"></script>

     

      

      <style type="text/css">

		  html{font-size:62.5%}

		  body{font-size:1.2em;color:#294f88}

		  .sample{margin:30px;border:1px solid #92cdec;background:#d7e7ff;padding:30px}

		  h1{margin:0 0 20px 0;padding:0;font-size:2em;}

		  h2{margin:40px 0 20px 0;padding:0;font-size:1.6em;}

		  .easy-accordion h2{margin:0px 0 20px 0;padding:0;font-size:1.6em;}

		  p{font-size:1.2em;line-height:170%;margin-bottom:20px}

		  		  

		 

		/* UNLESS YOU KNOW WHAT YOU'RE DOING, DO NOT CHANGE THE FOLLOWING RULES */

		

		.easy-accordion{display:block;position:relative;overflow:hidden;padding:0;margin:0}

		.easy-accordion dt,.easy-accordion dd{margin:0;padding:0}

		.easy-accordion dt,.easy-accordion dd{position:absolute}

		.easy-accordion dt{margin-bottom:0;margin-left:0;z-index:5;/* Safari */ -webkit-transform: rotate(-90deg); /* Firefox */ -moz-transform: rotate(-90deg);-moz-transform-origin: 20px 0px;  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);cursor:pointer;}

		.easy-accordion dd{z-index:1;opacity:0;overflow:hidden}

		.easy-accordion dd.active{opacity:1;}

		.easy-accordion dd.no-more-active{z-index:2;opacity:1}

		.easy-accordion dd.active{z-index:3}

		.easy-accordion dd.plus{z-index:4}

		.easy-accordion .slide-number{position:absolute;bottom:0;left:10px;font-weight:normal;font-size:1.1em;/* Safari */ -webkit-transform: rotate(90deg); /* Firefox */ -moz-transform: rotate(90deg);  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);}

		 

		 

		/* FEEL FREE TO CUSTOMIZE THE FOLLOWING RULES */

		

		dd p{line-height:120%}

		

		#accordion-1{width:800px;height:245px;padding:30px;background:#fff;border:1px solid #b5c9e8}

		#accordion-1 dl{width:800px;height:245px}	

		#accordion-1 dt{height:46px;line-height:44px;text-align:right;padding:0 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-1.jpg) 0 0 no-repeat;color:#26526c}

		#accordion-1 dt.active{cursor:pointer;color:#fff;background:#fff url(images/slide-title-active-1.jpg) 0 0 no-repeat}

		#accordion-1 dt.hover{color:#68889b;}

		#accordion-1 dt.active.hover{color:#fff}

		#accordion-1 dd{padding:25px;background:url(images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}

		#accordion-1 .slide-number{color:#68889b;left:10px;font-weight:bold}

		#accordion-1 .active .slide-number{color:#fff;}

		#accordion-1 a{color:#68889b}

		#accordion-1 dd img{float:right;margin:0 0 0 30px;}

		#accordion-1 h2{font-size:2.5em;margin-top:10px}

		#accordion-1 .more{padding-top:10px;display:block}

			

		#accordion-2{width:700px;height:195px;padding:30px;background:#fff;border:1px solid #b5c9e8}

		#accordion-2 h2{font-size:2.5em;margin-top:10px}

		#accordion-2 dl{width:700px;height:195px}	

		#accordion-2 dt{height:56px;line-height:44px;text-align:right;padding:10px 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-2.jpg) 0 0 no-repeat;color:#26526c}

		#accordion-2 dt.active{cursor:pointer;color:#fff;background:#fff url(images/slide-title-active-2.jpg) 0 0 no-repeat}

		#accordion-2 dt.hover{color:#68889b;}

		#accordion-2 dt.active.hover{color:#fff}

		#accordion-2 dd{padding:25px;background:url(images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}

		#accordion-2 .slide-number{color:#68889b;left:10px;font-weight:bold}

		#accordion-2 .active .slide-number{color:#fff}

		#accordion-2 a{color:#68889b}

		#accordion-2 dd img{float:right;margin:0 0 0 30px;position:relative;top:-20px}



		#accordion-3{width:700px;height:195px;padding:30px;background:#fff;border:1px solid #b5c9e8}

		#accordion-3 h2{font-size:2.5em;margin-top:10px}

		#accordion-3 dl{width:700px;height:195px}	

		#accordion-3 dt{height:56px;line-height:44px;text-align:right;padding:10px 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-2.jpg) 0 0 no-repeat;color:#26526c}

		#accordion-3 dt.active{cursor:pointer;color:#fff;background:#fff url(images/slide-title-active-2.jpg) 0 0 no-repeat}

		#accordion-3 dt.hover{color:#68889b;}

		#accordion-3 dt.active.hover{color:#fff}

		#accordion-3 dd{padding:25px;background:url(images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}

		#accordion-3 .slide-number{color:#68889b;left:13px;font-weight:bold}

		#accordion-3 .active .slide-number{color:#fff}

		#accordion-3 a{color:#68889b}

		#accordion-3 dd img{float:right;margin:0 0 0 30px;position:relative;top:-20px}



      </style>

      

</head>

<body>



    <div class="sample">

       
        <div id="accordion-1">

		
            <dl>

			
			<?php 		
								require("../../dbconnect.php");		
											$query = "SELECT DESCR,ACRONYM FROM MMR_FEAT WHERE ACRONYM IS NOT NULL ORDER BY FEATID ASC";
											$compiled = oci_parse($db, $query);
											oci_execute($compiled);
											while($row=oci_fetch_array($compiled))
											{
											?>
											<dt> </dt>												
												<dd><h2><?php echo $row[0]; ?></h2>
												<p><img src="images/monsters/img1.png" alt="Alt text to go here" />123
															
												</p>
												</dd>
											<?php 
											
											} 	
																					
			?>
            </dl>

        </div>

 		

        

    </div>    

</body>
 <script type="text/javascript" src="scripts/utility.js"></script>
</html>

