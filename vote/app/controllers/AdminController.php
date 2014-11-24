<?php

class AdminController extends BaseController
{

    /**
     * Instantiate a new AdminController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => array('getLogin', 'postLogin')));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        return Redirect::to('/admin/players');
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return Redirect::intended('/admin');
        }

        $this->layout = View::make('admin.login');
    }

    public function postLogin()
    {
        if (Auth::check()) {
            return Redirect::intended('/admin');
        }

        $data = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        $requires = array(
            'username' => 'required|max:20',
            'password' => 'required|'
        );

        $validator = Validator::make($data, $requires);
        if ($validator->fails()) {
            return Redirect::to('/admin/login')
                ->with(array('message' => '填入信息不正确'));
        }
        if (Auth::attempt(array('username' => $data['username'], 'password' => $data['password']))) {
            return Redirect::intended('/admin');
        } else {
            return Redirect::to('/admin/login')
                ->with(array('message' => '用户名或密码不正确'));
        }
    }

    public function getPlayers() {
        $this->layout = View::make('admin.players')
            ->with('players', Player::all());
    }

    public function getVotes() {

    }
}
