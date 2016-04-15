<tr>
	<td>{{$traffic->id}}</td>
	<td>{{$traffic->name}}</td>
	<td><img src="{{$traffic->logo_path}}" style="width:25px; height:25px"></td>
	<td>{{$traffic->cta_text}}</td>
	<td>{{$traffic->url}}</td>
	<td>{{$traffic->schedule}}</td>
	<td>
		<a href="/traffic-edit/{{ $traffic->id }}" class="glyphicon glyphicon-edit" title="Edit"></a>
		<a data-toggle="modal" href="#" data-target="#embedModal{{ $traffic->id }}" class="glyphicon glyphicon-link" title="Embed Code" style="margin-left: 5px; margin-right: 5px;"></a>
		<a data-toggle="modal" href="#" data-target="#removeModal{{ $traffic->id }}" title="Delete" class="glyphicon glyphicon-trash"></a>
		<div class="modal fade" id="removeModal{{ $traffic->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		    <div class="modal-dialog modal-sm">
		    	<form method="post" action="/traffic-delete/{{$traffic->id}}">
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

		<div class="modal fade" id="embedModal{{ $traffic->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		    <div class="modal-dialog">
		        <div class="modal-content">
			        <div class="modal-body">
			            <textarea class="form-control embed_code" rows="12" style="resize: none;">{{ $traffic->embed_code }}</textarea>
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