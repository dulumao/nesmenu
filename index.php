﻿<?php
include 'save.php';

$menu = getMenu();
?>
<html>
<head>
  <meta charset="utf-8">
  <title>NesMenu!</title>
  <link href="static/css/bootstrap.min.css" rel="stylesheet">
  <link href="static/css/nestable.css" rel="stylesheet">
  <style type="text/css">
    .tip-hide, .tip-msg {font-size: 0.5em;margin-left: 5px;color: #999;font-weight: 100; }
    .tip-msg {color: #449d44}
  </style>
</head>
<body>

<div class="container">

    <!-- MENU -->
    <div class="row">
	<div class="col-md-8">  
	    <div class="well">
                <p class="lead"><a href="#newModal" class="btn btn-default pull-right" data-toggle="modal">Add Menu</a> Menu: </p>
		<div class="dd" id="nestable">
		    <?php echo $menu; ?>
		</div>
	    </div>
	</div>
    </div>

    <!-- New menu dialog -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
                <form action="save.php?action=add" class="form-horizontal" role="form">
		    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">New Menu</h4>
		    </div>
		    <div class="modal-body">
			<div class="form-group">
			    <label for="title" class="col-lg-2 control-label">Title</label>
			    <div class="col-lg-10">
				<input type="text" name="title" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="icon" class="col-lg-2 control-label">Icon</label>
			    <div class="col-lg-10">
				<input type="text" name="icon" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="url" class="col-lg-2 control-label">URL</label>
			    <div class="col-lg-10">
				<input type="text" name="url" value="" class="form-control" />
			    </div>
			</div>
                        <div class="form-group">
			    <label for="hide" class="col-lg-2 control-label"></label>
			    <div class="col-lg-10">
                                <input type="checkbox" name="hide" value="1" class="checkbox-inline" />Hide
			    </div>
			</div>
		    </div>
		    <div class="modal-footer">
			<span class="prompt-msg text-danger" style="display:none;"></span>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
			<button type="submit" class="btn btn-primary">Create</button>
		    </div>
		</form>
	    </div>
	</div>
    </div>
  
    <!-- Edite Menu dialog -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
                <form action="save.php?action=edit" class="form-horizontal" role="form">
		    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Edit Menu</h4>
		    </div>
		    <div class="modal-body">
			<div class="form-group">
			    <label for="title" class="col-lg-2 control-label">Title</label>
			    <div class="col-lg-10">
				<input type="text" name="title" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="icon" class="col-lg-2 control-label">Icion</label>
			    <div class="col-lg-10">
				<input type="text" name="icon" value="" class="form-control" />
			    </div>
			</div>
			<div class="form-group">
			    <label for="url" class="col-lg-2 control-label">URL</label>
			    <div class="col-lg-10">
				<input type="text" name="url" value="" class="form-control" />
			    </div>
			</div>
		    </div>
                    <div class="form-group">
			    <label for="hide" class="col-lg-2 control-label"></label>
			    <div class="col-lg-10">
                                <input type="checkbox" name="hide" value="1" class="checkbox-inline" />Hide
			    </div>
                    </div>
		    <div class="modal-footer">
			<span class="prompt-msg text-danger" style="display:none;"></span>
			<input type="hidden" name="id" value="" />
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
			<button type="submit" class="btn btn-primary">Save</button>
		    </div>
		</form>
	    </div>
	</div>
    </div>
  
    <!-- Delete Menu dialog -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
                <form action="save.php?action=delete" method="post">
		    <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Comfirm</h4>
		    </div>
		    <div class="modal-body">
			<p>Are you sure delete this menu?</p>
		    </div>
		    <div class="modal-footer">
			<span class="prompt-msg text-danger" style="display:none;"></span>
			<input type="hidden" name="id" value="" />
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
		    </div>
		</form>
	    </div>
	</div>
    </div>

</div>

<script type="text/javascript" src='static/js/jquery-1.10.2.min.js'></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript" src='static/js/jquery.nestable.js'></script>

<script type="text/javascript">   
$(function() {
 
    // Process on drag
    $('.dd').nestable({
        maxDepth: 5,
        dropCallback: function(details) {

            var order = new Array();
            $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
                order[index] = $(elem).attr('data-id');
            });

            if (order.length === 0){
                var order = new Array();
                $("#nestable > ol > li").each(function(index,elem) {
                    order[index] = $(elem).attr('data-id');
                });
            }
            
            // don't post if nothing changed
            var data_id = window.location.hostname + '.nestable';
            var drag_data = JSON.stringify($('.dd').nestable('serialize'));
            var storage_data = localStorage.getItem(data_id);
            if (drag_data === storage_data) {
                return false;
            }
            localStorage.setItem(data_id, drag_data);
            
            // post data by ajax
            $.post(
                    'save.php?action=drag',
                    {
                        source : details.sourceId,
                        destination: details.destId,
                        order: JSON.stringify(order)
                    },
                    function(result) {
                        $("li[data-id='"+ details.sourceId +"']")
                                .find(".tip-msg")
                                .first()
                                .html(result.message)
                                .fadeIn(100)
                                .delay(1000)
                                .fadeOut();
                    },
                    'json'
            ).fail(function(result){
                alert("Failed: " + result.status + "：" + result.message);
                return ;
            });
        }
     });

    // Post by ajax on Create, Edit and Delte
    $('form').on('submit', function(e){
	e.preventDefault();
	var form = $(this);
        var submit_url = form.attr('action');
	
	$.post(
                submit_url,
                form.serialize(),
                function(result){
                    form.find(".prompt-msg").html(result.message).fadeIn(100).delay(1000).fadeOut();
                    if (result.status) {
                        setTimeout(function(){location.reload();}, 1000);
                    } else {
                        return;
                    }
                },
                'json'
        ).fail(function(result){
            alert("Failed: " + result.status + "：" + result.message);
            return ;
        });
    });

    // load menu id when click delete link
    $('.delete_toggle').click(function(e){
	e.preventDefault();
	$('#deleteModal').find('input[name=id]').val( $(this).attr('rel') );
    });

    // load input value when click edit link
    $('.edit_toggle').click(function(e){
	  e.preventDefault();
	  var menu = JSON.parse( $(this).attr('rel') );
	  $.each(menu, function(key, value) {
	      $('#editModal').find('input[type!=checkbox][name='+key+']').val(value);
              $('#editModal').find('input[type=checkbox][name='+key+']').attr('checked', (value==1)?true:false);
	  });
    });
    
});
</script>

</body>
</html>
