@extends('layouts.dashboard')

@section('content')
						 {{-- Passiamo lo slug perchè vogliamo creare l'url come slug e non l'id --}}
                         <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Title</th>
                                <th scope="col">descriptions</th>
                                <th scope="col">slug</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->content}}</td>
                                    <td>{{$post->slug}}</td>
                                    <td class="d-flex">
                                        {{-- bottone dettaglio  --}}
                                        <a class="btn btn-info" href="{{ route('admin.posts.show', $post->slug) }}" >Details</a>
                                        {{-- bottone di modifica --}}
                                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id)}}">Modify</a>
                                        {{-- bottone di cancellazione --}}
                                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
@endsection