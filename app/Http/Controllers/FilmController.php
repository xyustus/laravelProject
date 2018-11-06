<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Film;
use App\Comment;
use App\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $film1 = new Film();
        $film1->id = "1";
        $film1->name = "index";
        $film1->description = "Site Index";  
        $film1->price = "254";
        $films = array($film1);  

       // $films = Film::orderBy('created_at', 'asc')->get();
        $films = DB::table('films')->simplePaginate(1);
        

        return view('films',['films' => $films]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $genres = Genre::all();
        return view('film_create', [ 'genres'=> $genres]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create a separate validation file
       
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'rating' => 'required|between:1,5',
            'price' => 'required|between:0,99.99',
            'genre' => 'required'
        ]);
   

        $film1 = new Film();
        $film1->name = $request->input('name');
        $film1->description = $request->input('description');
        $film1->price = $request->input('price');
        $film1->rating = $request->input('rating');
        $film1->country = $request->input('country');
        $film1->genres = $request->input('genre');
        $film1->created_at = date("Y-m-d H:i:s");
        if( $request->hasFile('image')) {
            print_r("entrooooooooo");
            $image = $request->file('image');
            $path = public_path(). '/images/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);

            $film1->photo = $filename;
        }
        $film1->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);
        return view('film_details',['film' => $film]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Film::findOrFail($id)->delete();

        return redirect('/');
    }

    /////////////////////////////////////////comments///////////////////////////////
     /**
     * Add new comment to film.
     *
     * @param  string  $userComment
     * @param  integer $idFilm
     * @param  integer $idUser
     * @return \Illuminate\Http\Response
     */
    public function createComment(Request $request)
    {
        print_r($request->comment);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->film_id = $request->idFilm;
        $comment->user = Auth::user()->name;

        $comment->save();

        return redirect('/film/'.$request->idFilm);
    }
}
