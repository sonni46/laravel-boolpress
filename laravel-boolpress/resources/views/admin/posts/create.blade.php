@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article>
                    <h1>Vista Create Post</h1>
                    <form action="{{route('admin.posts.store')}}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input value="{{old('title')}}" type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-- Seleziona la categoria --</option>
                              @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{old('category_id') === $category->id ? 'selected' : null}}>
                                    {{ $category->name }}
                                </option>
                              @endforeach
                            </select>

                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <p>Seleziona i tag</p>
                            @foreach ($tags as $tag)

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

                            @endforeach
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Crea post</button>
                        </div>

                    </form>
                </article>
                
            </div>
        </div>
    </div>
@endsection