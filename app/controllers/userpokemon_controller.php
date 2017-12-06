<?php

class UserPokemonController extends BaseController {

    public static function showByUser($kayttaja_nimi) {
        self::check_logged_in();
        $userpokemons = UserPokemon::findByUser($kayttaja_nimi);

        View::make('userpokemon/userpokemon_list.html', array('userpokemons' => $userpokemons));
    }

    public static function create($user_nimi) {

        $pokemons = Pokemon::all();
        View::make('userpokemon/userpokemon_new.html', array('user' => $user_nimi, 'pokemons' => $pokemons));
    }

    public static function store($kayttaja_nimi) {


        $params = $_POST;

        $attributes = array(
            'pokemon_id' => $params['pokemon_id'],
            'kayttaja_nimi' => $kayttaja_nimi,
            'lempinimi' => $params['lempinimi'],
            'kaappauspvm' => $params['kaappauspvm'],
            'cp' => $params['cp'],
            'iv' => $params['iv']
        );
        $userpokemon = new UserPokemon($attributes);

//        $errors = $userpokemon->errors();
//        if (count($errors) == 0) {
        $userpokemon->save();
        Redirect::to('/userpokemon/' . $kayttaja_nimi, array('message' => 'Pokemon on lisätty kirjastoosi!'));
//        } else {
//            View::make('userpokemon/' . $kayttaja_nimi . '/new', array('errors' => $errors, 'attributes' => $attributes));
//        }
    }

    public static function show($id) {

        self::check_logged_in();

        $userpokemon = UserPokemon::find($id);

        View::make('userpokemon/userpokemon_show.html', array('userpokemon' => $userpokemon));
    }

    public static function edit($id) {
        $userpokemon = UserPokemon::find($id);
        $pokemons = Pokemon::all();
        View::make('userpokemon/userpokemon_edit.html', array('userpokemon' => $userpokemon, 'pokemons' => $pokemons));
    }

    public static function update($id) {

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'pokemon_id' => $params['pokemon_id'],
            'kayttaja_nimi' => $params['kayttaja_nimi'],
            'lempinimi' => $params['lempinimi'],
            'kaappauspvm' => $params['kaappauspvm'],
            'cp' => $params['cp'],
            'iv' => $params['iv']
        );
        $userpokemon = new UserPokemon($attributes);
//        $errors = $userpokemon->errors();
//        if (count($errors) > 0) {
//            View::make('userpokemon/userpokemon_edit.html', array('errors' => $errors, 'attributes' => $attributes));
//        } else {

        $userpokemon->update();
        Redirect::to('/userpokemon/s/' . $userpokemon->id, array('message' => 'Pokémonia on muokattu onnistuneesti!'));
//        }
    }

}
