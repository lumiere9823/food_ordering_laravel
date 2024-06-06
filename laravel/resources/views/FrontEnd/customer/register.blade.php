@extends('FrontEnd.master')

@section('title')
    Register Customer
@endsection

@section('content')
    <form method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="login-page about">
		<img class="login-w3img" src="images/img3.jpg" alt="">
		<div class="container"> 
			<h3 class="w3ls-title w3ls-title1">Sign Up to your account</h3>  
			<div class="login-agileinfo"> 
				<form action="#" method="post"> 
					<input class="agile-ltext" type="text" name="Username" placeholder="Username" required="">
					<input class="agile-ltext" type="email" name="Your Email" placeholder="Your Email" required="">
					<input class="agile-ltext" type="password" name="password" placeholder="Password" required="">
					<input class="agile-ltext" type="password" name="Confirm Password" placeholder="Confirm Password" required="">
					<div class="wthreelogin-text"> 
						<ul> 
							<li>
								<label class="checkbox"><input type="checkbox" name="checkbox"><i></i> 
									<span> I agree to the terms of service</span> 
								</label> 
							</li> 
						</ul>
						<div class="clearfix"> </div>
					</div>   
					<input type="submit" value="Sign Up">
				</form>
				<p>Already have an account?  <a href="{{route('login.show')}}"> Login Now!</a></p> 
			</div>	 
		</div>
	</div>
    </form>
@endsection