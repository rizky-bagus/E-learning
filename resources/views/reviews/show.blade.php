@extends('layouts.app')
@section('content')

<br>
<div class="wrapper">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">Show Data Reviews
</div>
<br>                                                            
<div class="panel-body">
	<div class="container">
		<div class="col-md-8">
								<!--Username-->
						<div class="form-group">
							<label>Name</label>
							<input name="name" class="form-control" placeholder="Name" type="text" value="{{ $review->name }}" readonly>
						</div>
								<!-- Foto -->
						<div class="form-group">
							<label>Foto</label><br>
							<img src="{{asset('Image/Review/'.$review->foto)}}" width="100p
							x" width="100px">
						</div>
								<!--Content-->
						<div class="form-group">
							<label>Review</label>
							<textarea id="content" type="textarea" class="form-control" placeholder="Content" name="review" readonly>{{ $review->review }}</textarea>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

@endsection