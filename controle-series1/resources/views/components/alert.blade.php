
<div class="alert {{$tipo}} alert-dismissible fade show" role="alert">

	<h3> {{ $title }} </h3>
	{{ $slot }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
</div>

