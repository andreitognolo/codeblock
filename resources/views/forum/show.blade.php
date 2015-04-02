@extends('master')

@section('css')

@stop

@section('content')
	<h2>{{$forum->title}}</h2>
	@if(count($forum->topics) > 0)
		<div class="forum">
			<div class="item invert">
				<div class="content">Topics</div>
				<div class="meta">Replies</div>
				<div class="meta">Last reply</div>
			</div>
			@foreach($forum->topics as $topic)
				@if(count($topic->replies) > 0)
					<div class="item">
						<div class="content margin-right-one">
							@if(Auth::check() && Auth::user()->hasRead($topic->id))
								<i class="fa fa-comment-o fa-2x"></i>
							@else
								<i class="fa fa-comment fa-2x"></i>
							@endif
						</div>
						<div class="content">
							{{HTML::actionlink($url = array('action' => 'TopicController@show', 'params' => array($topic->id)), $topic->title)}}
							<p>by {{HTML::actionlink($url = array('action' => 'UserController@showByUsername', 'params' => array($topic->replies->first()->user->username)), $topic->replies->first()->user->username)}}, {{$topic->replies->first()->created_at->diffForHumans()}}</p>
						</div>
						<div class="meta">{{count($topic->replies)}}</div>
						<div class="meta font-small">by {{HTML::actionlink($url = array('action' => 'UserController@showByUsername', 'params' => array($topic->replies->last()->user->username)), $topic->replies->last()->user->username)}}<br /> {{$topic->replies->last()->created_at->diffForHumans()}}</div>
					</div>
				@endif
			@endforeach
		</div>
	@else
		<div class="alert info">This forum have no topics yet.</div>
	@endif
	{{ Form::model(null, array('action' => 'TopicController@createOrUpdate')) }}
	<h3 class="margin-top-one">Create topic</h3>
	{{ Form::hidden('forum_id', Route::Input('id')) }}
	{{ Form::label('title','Title') }}
	{{ Form::text('title', Input::old('Title'), array('placeholder' => 'Topic title')) }}
	{{ $errors->first('title', '<div class="alert error">:message</div>') }}
	{{ Form::label('reply', 'Reply:') }}
	{{ Form::textarea('reply', Input::old('reply'), array('placeholder' => 'Topic reply', 'class' => 'mentionarea', 'id' => 'reply', 'data-validator' => 'required|min:3')) }}
	{{ $errors->first('reply', '<div class="alert error">:message</div>') }}
	{{ Form::button('Create', array('type' => 'submit')) }}
	{{ Form::close() }}
@stop

@section('script')

@stop                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       