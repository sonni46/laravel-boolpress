<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // Per la vista degli utenti
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare lo store 
        $request->validate([
            'title'=>'required|max:50',
            'content'=> 'required',
            'category_id'=>'exists:categories,id',
            'tags' => 'exists:tags,id',
            // 'image' => 'nullable|image'
        ]);

        // prende i dati da crate attraverso il form 
        $form_data = $request->all();

        // verifico se è stata caricata l'imagine 
        if(array_key_exists('image',$form_data)) {
            // salviamo l'imagine e recuperiamo il path
            $cover_path = Storage::put('post_covers',$form_data['image']);

            // aggiungiamo all'array  che viene usato nella funzione fill
            // la chiave cover che contiene il percorso relativo dell'imagine caricata a partire dal public storage 
            $form_data['cover'] = $cover_path;

        }
        // con il Post ritorniamo con l'array fillable
        $new_post = new Post(); /** Post è il model che si collega al database */
        // prendiamo fillable con il metodo fill e lo assegniamo a $form_data
        $new_post->fill($form_data);
        // il titolo diventera il nostro slug
        $slug = Str::slug($new_post->title, '-');
        // prendiamo lo slug presente nel database
        $slug_presente = Post::where('slug', $slug)->first();
        
        $contatore = 1;
        while($slug_presente){
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }

        $new_post->slug = $slug;
        $new_post->save();

        if(array_key_exists('tags',$form_data)) {
            $new_post->tags()->sync($form_data['tags']);
        }
        else {
            $new_post->tags()->sync([]);
        }
        return redirect()->route('admin.posts.index')->with('inserted', 'Il post è stato correttamente salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($slug) /** => scrivere lo slug fa ritornare il nome nel url invece che id */
    {
        // apre una pagina del sigolo dato 
        $post = Post::where('slug', $slug)->first();
        if(!$post){
            abort(404);
        }return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post){
            abort(404);
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post',"categories",'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|max:50',
            'content'=> 'required',
            'category_id'=>'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image'
        ]);
        // salviamo in una var tutte le modifiche
        $form_data = $request->all();


        // vediamo se l'immagine esiste 
        if(array_key_exists('image',$form_data)) {
            Storage::delete($post->cover);
            $cover_path = Storage::put('post_covers',$form_data['image']);

            // aggiungiamo all'array  che viene usato nella funzione fill
            // la chiave cover che contiene il percorso relativo dell'imagine caricata a partire dal public storage 
            $form_data['cover'] = $cover_path;
        }
				
		// Creiamo lo slug prendendo il titolo
        if($form_data['title'] != $post->title){
            $slug = Str::slug($form_data['title'], '-');
						
			// Se lo slug è già esistente, aggiungiamo un contatore per
			// renderlo unico
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore = 1;
            while($slug_presente){
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }
						
			// salviamo il nuovo slug
            $form_data['slug'] = $slug;
        }
				
		// Salviamo il post con tutte le modifiche
        $post->update($form_data);

        if(array_key_exists('tags',$form_data)) {
            $post->tags()->sync($form_data['tags']);
        }
        else {
            $post->tags()->sync([]);
        }


        // Dopo la modifica rimandiamo all'index dei posts
        return redirect()->route('admin.posts.index')->with('updated', 'Post correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato');
    }
}
