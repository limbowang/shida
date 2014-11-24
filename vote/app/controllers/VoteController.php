<?php

class VoteController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
//        $this->beforeFilter('csrf', array('on' => 'post'));
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('vote.index')
            ->with('players', Player::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        App::abort(404);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = array(
            'username' => '',
            'password' => Input::get('password'),
            'pid' => Input::get('pid')
        );

        if (Input::get('username')) {
            $data['username'] = Input::get('username');
        } else if (Session::get('username')) {
            $data['username'] = Session::get('username');
        } else {
            return Response::json(array('result' => 'error', 'msg' => '输入信息不全或有误'));
        }

        $requires = array(
            'username' => 'required|max:10',
            'pid' => 'required|numeric|max:15|min:1',
            'password' => ''
        );

        if(Input::get('username')) {
            $requires['password'] = 'required';
        }

        $validator = Validator::make($data, $requires);
        if ($validator->fails()) {
            return Response::json(array('result' => 'error', 'msg' => '输入信息不全或有误'));
        }

        if (!$this->auth($data['username'], $data['password'])) {
            return Response::json(array('result' => 'error', 'msg' => '身份验证失败'));
        }

        $user = User::where('sid', $data['username'])->first();
        if (!$user) {
            $user = new User();
            $user->sid = $data['username'];
            $user->count = 1;
        } else if (strstr($user->updated_at, date("Y-m-d")) && $user->count >= 3) {
            Session::set('count', $user->count);
            Session::set('date', $user->updated_at);
            return Response::json(array('result' => 'error', 'msg' => '你今天已投票3次。明天再来吧。'));
        } else {
            $user->count += 1;
        }

        $vote = Vote::where('sid', $data['username'])
            ->where('pid', $data['pid'])
            ->whereRaw('DATE(created_at)=CURDATE()')->get();

        if (sizeof($vote) != 0) {
            return Response::json(array('result' => 'error', 'msg' => '您今天已对该选手投票'));
        }

        // update user
        $user->save();
        // create vote
        $vote = new Vote();
        $vote->sid = $data['username'];
        $vote->pid = $data['pid'];
        $vote->save();
        // update player
        $player = Player::where('pid', $data['pid'])->first();
        $player->counts += 1;
        $player->save();

        Session::set('count', $user->count);
        Session::set('date', $user->updated_at);

        return Response::json(array('result' => 'success'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        App::abort(404);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        App::abort(404);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        App::abort(404);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        App::abort(404);
	}

    public function auth($username, $password) {

        if (Session::get('username') == $username && Hash::check($username, Session::get('token'))) {
            return true;
        }
        $curlPost = 'IDToken0=&IDToken1=' . $username . '&IDToken2=' .$password . '&IDButton=Log+In&goto=null&gx_charset=UTF-8';
        $ch = curl_init();//初始化curl
        curl_setopt($ch,CURLOPT_URL, 'http://tjis.tongji.edu.cn:58080/amserver/UI/Login');//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        if ($data == '') {
            Session::set('username', $username);
            Session::set('token', Hash::make($username));
        }

        return $data == '';
    }

}
