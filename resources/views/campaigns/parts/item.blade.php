<tr>
	<td>{{$campaign->id}}</td>
	<td>{{$campaign->label}}</td>
	<td><a target="_blank" href="{{ $campaign->url }}">{{$campaign->url}}</a></td>
	<td>{{$campaign->type == 'hb' ? 'hello bar' : 'traffic'}}</td>	
	<td>
		<a href="/campaigns/{{ $campaign->id }}" class="glyphicon glyphicon-edit" title="Show"></a>
		<a data-toggle="modal" href="#" data-target="#embedModal{{ $campaign->id }}" class="glyphicon glyphicon-link" title="Embed Code" style="margin-left: 5px; margin-right: 5px;"></a>
		<a data-toggle="modal" href="#" data-target="#removeModal{{ $campaign->id }}" title="Delete" class="glyphicon glyphicon-trash"></a>
		<a href="/campaigns/schedule/{{ $campaign->id }}" class="glyphicon glyphicon-time" style="margin-left: 5px;"></a>
		<div class="modal fade" id="removeModal{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		    <div class="modal-dialog modal-sm">
		    	{!! Form::open(['url' => '/campaigns/'.$campaign->id, 'method' => 'delete']) !!}
			        <div class="modal-content">
				        <div class="modal-body">
				            Are you sure you want to delete ?
				        </div>
				        <div class="modal-footer">
				            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				            <button type="submit" id="remove-contact" class="btn btn-danger btn-sm">Delete</button>
				        </div>
			        </div>
		    	{!! Form::close() !!}
		    </div>
		</div>

		<div class="modal fade" id="embedModal{{ $campaign->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		    <div class="modal-dialog">
		        <div class="modal-content">
			        <div class="modal-body">
			            <textarea class="form-control embed_code" rows="12" style="resize: none;">{{ $campaign->embed_code }}</textarea>
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
	