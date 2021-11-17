@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Contatti</h1>
                <form action="{{ route('contact.send')}}" method="post">
                    @csrf
                    <div class="form-grup">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="name" class="form-controler" required>
                    </div>
                    <div class="form-grup">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-controler" required>
                    </div>
                    <div class="form-grup">
                        <label for="message">Messaggio</label>
                        <textarea type="message" name="message" id="message" class="form-controler" required></textarea>
                    </div>
                    <div class="form-grup">
                        <input type="submit" class="btn btn-primary" value="Invia">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection