<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Widget::truncate();

        factory(Widget::class, 50)->create();

        // $this->call('UserTableSeeder');

        Model::reguard();
    }
}
