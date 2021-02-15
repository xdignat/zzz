<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user')->unique();  //логин
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('group_id')->on('groups');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        $item = User::create([
            'user' => 'root',
            'email' => 'root',
        ]);
        $item->setPassword('root');
        $item->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
