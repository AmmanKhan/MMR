<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( !isset($_SESSION['user'])) {
	//you are already logged in
  header("Location: index.php");
  exit;
 }
//include("page_access.php");
?>

<html>

<head>
	
    <link rel="stylesheet" href="dist/style.min.css" />
    <script src="dist/jquery-2.2.4.js"></script>
    <script src="dist/jstree.min.js"></script>
	<script src="dist/jquery.checkboxes-1.2.0.min.js"></script>
	<script src="dist/jquery-2.2.4.js"></script>
    <script src="dist/jstree.min.js"></script>
	
<script type="text/javascript">
$(document).ready(function () {
	
		var get_select_group;

	$('#tree-container').jstree({
		 
		'core': {
			'data': {
				'url': 'response.php?operation=get_node',
				'data': function (node) {
					return {
						'id': node.id
					};
				},
				"dataType": "json"
			},
			'check_callback': true,
			'themes': {
				'responsive': false
			}
		},
		//'plugins': ['state', 'contextmenu', 'wholerow','checkbox'] //Previous state maintained
		'plugins': [ 'state','contextmenu'],
						"contextmenu":{       
					"items": function ContextMenu($node) {
	var tree = $("#tree-container").jstree(true);
    var items_m =  {
							Create: {
								"separator_before": false,
								"separator_after": false,
								"label": "Create",
								"action": function (obj) { 
									$node = tree.create_node($node);
									//tree.edit($node);
								}
							},
							Rename: {
								"separator_before": false,
								"separator_after": false,
								"label": "Rename",
								"action": function (obj) { 
									tree.edit($node);
								}
							},                         
							Remove: {
								"separator_before": false,
								"separator_after": false,
								"label": "Delete",
								"action": function (obj) { 
									tree.delete_node($node);
								}
							},
							cpp:{
                            "separator_before": false,
                            "separator_after": false,
                             label: "Edit",
                            action: !1,
                            submenu: {
									Cut: {
										"separator_before": false,
										"separator_after": true,
										label: "Cut",
										action: function (obj) {
										   tree.cut($node);
										}
									},
									Paste: {
										"separator_before": false,
										"separator_after": false,
										label: "Paste",
										action: function (obj) {
											//var  pos1 = tree.get_selected();
											//alert(pos);										
										   tree.paste($node);
										}
									}
								}
							}
							
						}; // var itemsq
						<?php $roles = $_SESSION['roles']; 
						  echo 'var role_obj= '.json_encode($roles).';';
						  ?>
						if (role_obj == "A") {
							
						}
						
						if (role_obj == "E") {
							
							if($node.id == 1)
							{
							delete items_m.Create;
							delete items_m.Remove;
							delete items_m.Rename;
							delete items_m.cpp
							}
							delete items_m.Remove;
							
							var node_text = tree.get_node(tree.get_selected()[0]).text;
							//console.log(tree.get_selected()[0]);
							//console.log(tree.get_node(tree.get_selected()[0]).text);
							if (node_text != "New node") {
								delete items_m.Rename;
							}
						}
						
						if (role_obj == "U") {
							delete items_m.Create;
							delete items_m.Remove;
							delete items_m.Rename;
							delete items_m.cpp
							//delete items_m.cpp.submenu.Cut;
						}
						
						/*var node_text = tree.get_node(tree.get_selected()[0]).text;
						//console.log(tree.get_selected()[0]);
						//console.log(tree.get_node(tree.get_selected()[0]).text);
						if (node_text != "New node") {
							delete items_m.Rename;
						}*/
						
						return items_m;
					}
						
			},		//context menu
	}).on('create_node.jstree', function (e, data) {			//Create Node
		//var name1 = data.node.text;
		//alert(name1);
		//location.reload();

		$.get('response.php?operation=create_node', {
				'id': data.node.parent,
				'position': data.position,
				'text': data.node.text
			})
			.done(function (d) {
				var d = JSON.parse(d);
				data.instance.set_id(data.node, d.id);
				console.log("Node Created");
				data.instance.edit(d.id);
				//alert("DONE");
				//$('#tree-container').jstree("refresh");
			})
			.fail(function () {
				data.instance.refresh();
				//alert("FAIL");
			});
		//location.reload();
		//$('#tree-container').jstree("refresh");
	}).on('rename_node.jstree', function (e, data) {			//Rename Node
		$.get('response.php?operation=rename_node', {
				'id': data.node.id,
				'text': data.text
			})
			.fail(function () {
				data.instance.refresh();
			});
	}).on('delete_node.jstree', function (e, data) {			//delete_node
		$.get('response.php?operation=delete_node', {
				'id': data.node.id
			}).done(function (){
				$('#tree-container').jstree("refresh");
			})
			.fail(function () {
				data.instance.refresh();
			});
	});
	
	
// $('#tree-container').on('cut.jstree',function(e,data){
		
		
		// alert("Node Data is " + JSON.stringify(data.node));
		// alert("CUT");
	// });
	
	// $('#tree-container').on('copy.jstree',function(e,data){
		
		
		// alert("Node Data is " + JSON.stringify(data.node));
		// alert("COPY");
	// });
	
	// $('#tree-container').on('paste.jstree',function(e,data){
		// alert("Node Data is " + JSON.stringify(data.node));
		// alert("Paret Id of Recieving node is " + JSON.stringify(data.parent));
		// alert("mode is " + data.mode);
		// alert("COPY");
	// });
var cut_node_id ;	//would be id (primary Key) of pasted node
var cut_node_text;
				
	var paste_recieving_node_id;		//would be parent id of pasted node
	
	$('#tree-container').on('cut.jstree',function(e,data){
		
		cut_node_id = data.node[0].id;
		cut_node_text = data.node[0].text;
		/* alert("Node Data is " + JSON.stringify(data.node));
		alert("CUT"); */
	});
	
	$('#tree-container').on('copy.jstree',function(e,data){
		
		
		alert("Node Data is " + JSON.stringify(data.node));
		alert("COPY");
	});
	
		
	$('#tree-container').on('paste.jstree',function(e,data){
		
		paste_recieving_node_id = data.parent;
		$.get('response.php?operation=paste_node', {
				'id': parseInt(cut_node_id),
				'parent': parseInt(paste_recieving_node_id),
				'text' : cut_node_text
			})
			.done(function (d) {
				
				cut_node_id = paste_recieving_node_id = "";
				//alert("primary key " + cut_node_id + ", Parent " + paste_recieving_node_id);
				$('#tree-container').jstree("refresh");
				//alert("DONE");
			})
			.fail(function () {
				$('#tree-container').jstree("refresh");
				//alert("FAIL");
			});
			
		
	});	
	
	$('#inbtn').click(function(){
		$('#in_tble').css('display','block');
		$('#ex_tble').css('display','none');
	});
	
	$('#exbtn').click(function(){
		$('#in_tble').css('display','none');
		$('#ex_tble').css('display','block');
	});
	
	/* $('#btnadd').click(function(){
		$('#in_btn,#ex_btn').css('display','inline-block');
	}); */
	
});
		

</script>
</head>


<body>

<div id="wrapper" >
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			

			
			
			
			<div class="collapse navbar-collapse navbar-ex1-collapse">
               <?php //include("sms_menu.php"); ?>
            </div>
			
 </nav>
 
 
	<div id="page-wrapper" >
    <!-- YOUR CONTENT GOES HERE -->
		<div class="container-fluid">
			 
			
			<div>
			
			
			
				<!--<div class="container">
				</div>-->
				
			
			
			<table width="100%" >
			<tr>
			<td valign="top" style="width: 20%;">
				
				<div id="tree-container"></div>
				
				
			</td>
			
			</tr>
			</table>
			
			
		</div>
		</div>
	</div>

	</div>
	
</div>

</body>

</html>