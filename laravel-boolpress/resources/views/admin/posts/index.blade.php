@extends('layouts.dashboard')

@section('content')
    <ul>
        @foreach ($posts as $post)
						 {{-- Passiamo lo slug perchè vogliamo creare l'url come slug e non l'id --}}
            <li>
                <a href="{{ route('admin.posts.show', $post->slug) }}">{{$post->title}}</a>
            </li>
        @endforeach
    </ul>
@endsection