@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Breadcrumb::withLinks(['Home' => '/', 'Login']) !!}

			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@include('errors.list')

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
							<div class="col-md-6 col-md-offset-4">
								<input type="checkbox" name="remember"> Remember Me
							</div>
						</div>

						<div class="form-group">							
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">Login</button>
								<a href="/password/email">Forgot ur password</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection