<tr>
	<td>{{$hello_bar->id}}</td>
	<td>{{$hello_bar->name}}</td>
	<td>{{$hello_bar->cta_text}}</td>
	<td>{{$hello_bar->target_url}}</td>
	<td>{{$hello_bar->schedule}}</td>
	<td>
		<a href="/hello-bar-edit/{{ $hello_bar->id }}" class="glyphicon glyphicon-edit" title="Edit"></a>
		<a data-toggle="modal" href="#" data-target="#embedModal{{ $hello_bar->id }}" class="glyphicon glyphicon-link" title="Embed Code" style="margin-left: 5px; margin-right: 5px;"></a>
		<a data-toggle="modal" href="#" data-target="#removeModal{{ $hello_bar->id }}" title="Delete" class="glyphicon glyphicon-trash"></a>
		<div class="modal fade" id="removeModal{{ $hello_bar->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		    <div class="modal-dialog modal-sm">
		    	<form method="post" action="/hello-bar-delete/{{$hello_bar->id}}">
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <div class="modal-content">
				        <div class="modal-body">
				            Are you sure you want to delete ?
				        </div>
				        <div class="modal-footer">
				            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				            <button type="submit" id="remove-contact" class="btn btn-danger btn-sm">Delete</button>
				        </div>
			        </div>
		    	</form>
		    </div>
		</div>

		<div class="modal fade" id="embedModal{{ $hello_bar->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		    <div class="modal-dialog">
		        <div class="modal-content">
			        <div class="modal-body">
			            <textarea class="form-control embed_code" rows="12" style="resize: none;">{{ $hello_bar->embed_code }}</textarea>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
			            <button class="btn btn-success btn-sm copy_embed">Copy</button>
			        </div>
		        </div>
		    </div>
		</div>
	</td>
</tr>
	