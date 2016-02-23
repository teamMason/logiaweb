<?php

namespace portalLogia\Http\Controllers;

use portalLogia\User;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Http\Requests\contactoRequest;
use portalLogia\Posts;
use portalLogia\Contacto;
use portalLogia\Libro;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class navegacion extends Controller
{
    public function home()
    {
        return view('home');

    }

    public function news()
    {
    	/*$posts = \DB::table('Posts')->orderBy('id','desc')->paginate(7);
        return view('blog.news')
        ->with('posts',$posts);*/

        $posts = \DB::table('posts')->where('estatus', 'publicar')->orderBy('id','desc')->paginate(10);
        return view('blog.news')
        ->with('posts',$posts);       


      

        
    }

    public function article($slug)
    {

        $posts = Posts::findBySlug($slug);
        return view('blog.article')
        ->with('posts', $posts);




    }

    public function tags($tag)
    {
        $posts = Posts::where('tags', 'LIKE','%'.$tag.'%')->orderBy('id','desc')->get();
        return view('blog.tags')
        ->with('posts', $posts)->with('tag', $tag);
    }


    //contacto

    public function guardarContacto(contactoRequest $request)
    {
        $c = Contacto::Create($request->all());
        

      
        $c->nombre = \Input::get('nombre');
        $c->email = \Input::get('email');
        $c->telefono = \Input::get('telefono');
        $c->mensaje = \Input::get('mensaje'); 
        $c->leido   = \Input::get('leido');      
        $c->save();
         return \Redirect::route('home')
         ->with('alert', 'Gracias por contactarnos, nos pondremos en contacto lo más pronto posible.');
    }

    public function redirect()
    {

        return view('sections.gracias');
    }

    public function bibliotecaMiembros()
    {
        $grado = \Auth::user()->id_type;
        $libros [] = '';



        if ($grado >= 1 and $grado <= 5)
        {
            $libros = \DB::table('libros')
                ->orderBy('grado','desc')
                ->paginate(50);


        }
        elseif($grado == 6 ) {

            $libros = \DB::table('libros')
                ->where('grado', '!=', 3)
                ->orderBy('titulo', 'desc')
                ->paginate(50);
        }
        else
        {
            $libros = \DB::table('libros')
                ->where('grado',1)
                ->orderBy('grado','desc')
                ->paginate(50);



        }
        return view('biblioteca.bibliotecaMiembros')
            ->with('libros',$libros);
    }




}


