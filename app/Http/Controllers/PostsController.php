<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Näytetään kaikki päiväkirjassa kirjoitetut postaukset
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //dd($user->posts());
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(6);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Annetaan validointi päiväkirjan postauksen otsikkoon, tekstikentään ja kuvaan
        $this->validate($request,[
            // Otsikko pakollinen
            'title' => 'required',
            // Tekstikenttä pakollinen
            'body' => 'required',
            // Kuvan maksimi koko saa olla 1,998 Mb asti, kuva ei ole pakollinen
            'image' => 'image|nullable|max:1998'
        ]);

        if($request->hasFile('image')){
            // Haetaan tiedoston nimi loppuosalla (.jpg, .png jne.)
            $fileNameExtension = $request->file('image')->getClientOriginalName();
            // Haetaan pelkkä tiedostonimi ilman loppuosaa
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            // Haetaan pelkkä tiedoston loppusa
            $extension = $request->file('image')->getClientOriginalExtension();
            // Tehdään tiedostonimi tallentamista varten tietokantaan
            // Tiedostonimessä lisätään aikamerkintää, joten tiedostonimi ei voi olla samanlainen muiten kanssa
            $fileToDB = $fileName.'_'.time().'.'.$extension;
            // Kuvan lataaminen
            $path = $request->file('image')->storeAs('public/uploaded_images', $fileToDB);
        } else {
            $fileToDB = 'noimg.jpg';
        } 

        // Päiväkirjan tallentaminen
        $newDiary = new Post();
        $newDiary->title = $request['title'];
        $newDiary->body = $request['body'];
        $newDiary->image = $fileToDB;
        $newDiary->user_id = auth()->user()->id;
        $newDiary->save();
        return redirect('posts')->with('success','Diary has been created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Näytä tietty päiväkirja
       $post = Post::find($id);
       return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Päiväkirjan editoinnin näkymä
        $diary = Post::find($id);
        return view('posts.edit')->with('diary',$diary);
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
                // Annetaan validointi päiväkirjan postauksen otsikkoon ja tekstikentään 
                $this->validate($request,[
                    'title' => 'required',
                    'body' => 'required'
                ]);

                if($request->hasFile('image')){
                    // Haetaan tiedoston nimi loppuosalla (.jpg, .png jne.)
                    $fileNameExtension = $request->file('image')->getClientOriginalName();
                    // Haetaan pelkkä tiedostonimi ilman loppuosaa
                    $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
                    // Haetaan pelkkä tiedoston loppusa
                    $extension = $request->file('image')->getClientOriginalExtension();
                    // Tehdään tiedostonimi tallentamista varten tietokantaan
                    // Tiedostonimessä lisätään aikamerkintää, joten tiedostonimi ei voi olla samanlainen muiten kanssa
                    $fileToDB = $fileName.'_'.time().'.'.$extension;
                    // Kuvan lataaminen
                    $path = $request->file('image')->storeAs('public/uploaded_images', $fileToDB);
                }

                // Editoinnin tallentaminen tietokantaan
                $diaryUpdate = Post::find($id);
                $diaryUpdate->title = $request['title'];
                $diaryUpdate->body = $request['body'];
                // Jos uploadataan uusi kuva vanhan kuvan tilalle, vanha kuva poistetaan
                if($request->hasFile('image')){
                    Storage::delete('public/uploaded_images/' . $diaryUpdate->image);
                    $diaryUpdate->image = $fileToDB;
                }
                
                $diaryUpdate->save();
                return redirect('posts')->with('success', 'Diary edited successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Päiväkirjan poistaminen
        $diary = Post::find($id);

        // Poistetaan kuva storage kansiosta samalla kun koko postaus poistetaan
        if($diary->image != 'noimg.jpg') {
            Storage::delete('public/uploaded_images/'.$diary->image);
        }

        $diary->delete();

        return redirect('posts')->with('success','Diary deleted successfully!');
    }
}
