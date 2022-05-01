<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(config('services.tmdb.token'));
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get(
                'https://api.themoviedb.org/3/movie/popular?api_key=' . config('services.tmdb.token')
            )
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=' . config('services.tmdb.token'))
            ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . config('services.tmdb.token'))
            ->json()['genres'];


        $genres = collect($genresArray)->mapwithkeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
        // dd($genres);

        // $viewModel = new MoviesViewModel(
        //     $popularMovies,
        //     $nowPlayingMovies,
        //     $genres,
        // );

        return view('index', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres
        ]);
        // return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get(
                'https://api.themoviedb.org/3/movie/' . $id  . '?api_key=' . config('services.tmdb.token') . '&append_to_response=credits,videos,images'
            )
            ->json();
        return view('show', ['movie' => $movie,]);
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
        //
    }
}