@php
    $title = __('User') . ': ' . $user->name;
@endphp

@extends('../layouts/app')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>

@if (isOneselfOrAdmin($user->id))
    <div>
        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-primary">
            {{ __('Edit') }}
        </a>
        @component('form-del')
            @slot('table', 'users')
            @slot('id', $user->id)
        @endcomponent
    </div>
@endif

<dl>
    <dt>ID</dt>
    <dd>{{ $user->id }}</dd>
    <dt>{{ __('Name') }}</dt>
    <dd>{{ $user->name }}</dd>
    @if (isOneselfOrAdmin($user->id))
        <dt>{{ __('Email') }}</dt>
        <dd>{{ $user->email }}</dd>
    @endif
</dl>

<h2>{{ __('Posts') }}</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Body') }}</th>
                <th>{{ __('Created') }}</th>
                <th>{{ __('Updated') }}</th>
                @if (isOneselfOrAdmin($user->id))
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($user->posts as $post)
                <tr>
                    <td>
                        <a href="{{ url('posts/' . $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td>{{ $post->body }}</td>
                    <td>{{ $post->created_at->format('Y年m月d日 H:i:s') }}</td>
                    <td>{{ $post->updated_at->format('Y年m月d日 H:i:s') }}</td>
                    @if (isOneselfOrAdmin($user->id))
                        <td nowrap>
                            <a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-primary">
                                {{ __('Edit') }}
                            </a>
                            @component('form-del')
                                @slot('table', 'posts')
                                @slot('id', $post->id)
                            @endcomponent
                        </td>
                    @endif
                 </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $user->posts->links() }}

@endsection
