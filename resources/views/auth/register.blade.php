@extends('layouts.master')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Breadcrumb::withLinks(['Home' => '/', 'Register']) !!}

			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@include('errors.list')

					{!! Form::open(['url' => 'auth/register', 'class' => 'form-horizontal']) !!}
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Subscribe to Newsletter</label>
							<div class="col-md-6">
								<input type="checkbox" name="is_subscribed">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<a href="/terms-of-service">Agree to terms</a>
							</label>
							<div class="col-md-6">
								<input type="checkbox" name="terms" required>
							</div>
						</div>						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Register</button>
							</div>
						</div>

					{!! Form::close() !!}
				</div>
			</div>

		</div>
	</div>
</div>

@endsection