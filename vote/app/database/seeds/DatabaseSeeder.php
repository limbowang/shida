<?php

use \Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		 $this->call('PlayerSeeder');
        $this->call('AdminSeeder');
	}

}

class PlayerSeeder extends Seeder {
    public function run() {
        DB::table('players')->delete();

        $players = array(
            array('pid'=>1, 'name'=>'TINY SUPERMAN'),
            array('pid'=>2, 'name'=>'NEVERS'),
            array('pid'=>3, 'name'=>'胡天天'),
            array('pid'=>4, 'name'=>'陈啸通'),
            array('pid'=>5, 'name'=>'邱婷婷'),
            array('pid'=>6, 'name'=>'温凯蓝'),
            array('pid'=>7, 'name'=>'莎拉'),
            array('pid'=>8, 'name'=>'徐天成'),
            array('pid'=>9, 'name'=>'包行飞'),
            array('pid'=>10, 'name'=>'徐家杰'),
            array('pid'=>11, 'name'=>'曹雯'),
            array('pid'=>12, 'name'=>'Balduin Benesch'),
            array('pid'=>13, 'name'=>'田圣泽'),
            array('pid'=>14, 'name'=>'刘依凡'),
            array('pid'=>15, 'name'=>'Crystella'),
        );
        foreach ($players as $player) {
            Player::create($player);
        }
    }
}

class AdminSeeder extends Seeder {
    public function run() {
        DB::table('admins')->delete();

        $admins = array(
            array('username' => $_ENV['ADMIN_USERNAME'], 'password' => Hash::make($_ENV['ADMIN_PASSWORD']))
        );
        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
