@if(Alert::has('error'))
	<div class="alert alert-danger">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    <ul>{{ implode('', Alert::get('error', '<li class="error">:message</li>')) }}</ul>
	</div>
@endif

@if(Alert::has('warning'))
	<div class="alert alert-warning">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    <ul>{{ implode('', Alert::get('warning', '<li class="warning">:message</li>')) }}</ul>
	</div>
@endif

@if(Alert::has('success'))
	<div class="alert alert-success">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    <ul>{{ implode('', Alert::get('success', '<li class="success">:message</li>')) }}</ul>
	</div>
@endif

@if(Alert::has('info'))
	<div class="alert alert-info">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    <ul>{{ implode('', Alert::get('info', '<li class="info">:message</li>')) }}</ul>
	</div>
@endif
