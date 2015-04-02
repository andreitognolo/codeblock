<ul class="float-left">
	<li class="divider"></li>
	{{HTML::actionlink($url = array('action' => 'MenuController@index'), '<i class="fa fa-home"></i>Home', array(), $before = '<li>', $after = '</li>')}}
	{{HTML::actionlink($url = array('action' => 'MenuController@browse'), '<i class="fa fa-folder-open"></i>Browse', array(), $before = '<li>', $after = '</li>')}}
	{{HTML::actionlink($url = array('action' => 'MenuController@contact'), '<i class="fa fa-phone"></i>Contact', array(), $before = '<li>', $after = '</li>')}}
</ul>
<ul class="float-right">
	@if(Auth::check())
		<li><a href="/forum"><i class="fa fa-comments"></i>Forum</a></li>
		@if(Auth::user()->role == 2)
			<li class="dropdown">
				<a href="/users" class="hideUl">
					<i class="fa fa-group"></i>Admin
					<i class="fa fa-bars only-small display-inline"></i>
				</a>
				<ul>
					<li><a href="/users">Users</a></li>
					<li><a href="/posts">Codeblocks</a></li>
					<li><a href="/tags">Tags</a></li>
					<li><a href="/categories">Categories</a></li>
					<li><a href="/comments">Comments</a></li>
					<li><a href="/forums">Forums</a></li>
					<li><a href="/roles">Roles</a></li>
					<li><a href="/permissions">Permissions</a></li>
				</ul>
			</li>
		@endif
		<li class="dropdown">
			<a href="/user/list" class="hideUl">
				<i class="fa fa-code"></i>My Codeblocks
				<i class="fa fa-bars only-small display-inline"></i>
			</a>
			<ul>
				<li><a href="/user/list">List</a></li>
				<li><a href="/posts/create">Create</a></li>
				<!-- <li><a href="/comments">Comments</a></li> -->
			</ul>
		</li>
		<li><a href="/user"><i class="fa fa-user"></i>Profile</a></li>
		<li><a href="/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
	@else
		{{HTML::actionlink($url = array('action' => 'UserController@login'), '<i class="fa fa-sign-in"></i>Login / Sign Up', array(), $before = '<li>', $after = '</li>')}}
	@endif
	<li class="divider"></li>
	<li class="form">
		<a class="search" href="#">
			<i class="fa fa-search"></i>
		</a>
		{{ Form::open(array('action' => 'PostController@search')) }}
		{{ Form::text('term', null, array('placeholder' => 'Search')) }}
		{{ Form::close() }}
	</li>
</ul>