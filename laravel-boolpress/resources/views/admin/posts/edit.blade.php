@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <article>
                <h1>Modifica Post</h1>

                <form action="{{route('admin.posts.update', $post->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input value="{!! old('title') , $post->title !!}" type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror">{!! old('content') , $post->content !!}</textarea>
                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">-- Seleziona la categoria --</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{old('category_id', $post->category_id) === $category->id ? 'selected' : null}}>
                                {{ $category->name }}
                            </option>
                          @endforeach
                          @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </select>
                    </div>

                    <div class="form-group">
                        <p>Seleziona i tag</p>
                        @foreach ($tags as $tag)

                        <div class="form-check form-check-inline">

                            @if ($errors->any())
                            
                                <input  
                                {{ in_array($tag->id, old('tags',[])) ? 'checked' : null }}
                                value="{{ $tag->id }}" id="{{'tag' . $tag->id }}" type="checkbox" name="tags[]" class="form check-input">
                                <label for="{{'tag' . $tag->id }}" class="form-check-label" for=""> {{ $tag->name}}</label>
                            
                            @else

                                <input 
                                {{ $post->tags->contains($tag->id) ? 'checked' : null }} 
                                value="{{ $tag->id }}" id="{{'tag' . $tag->id }}" type="checkbox" name="tags[]" class="form check-input">
                                <label for="{{'tag' . $tag->id }}" class="form-check-label" for="{{'tag' . $tag->id }}"> {{ $tag->name}}</label>
                            
                            @endif
                        </div>
                        
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button  type="submit" class="btn btn-success">Modifica post</button>
                    </div>

                </form>
            </article>
            
        </div>
    </div>
</div>
@endsection