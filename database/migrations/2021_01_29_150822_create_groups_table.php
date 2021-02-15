<?php

use App\Models\Group;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('group_id');
            $table->string('group')->unique();
            $table->string('description')->nullable();
            $table->boolean('enabled')->default(true);
            $table->json('permissions')->nullable();
            $table->softDeletes();
            $table->timestamps();
            //$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            //$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Group::create([
            'group_id' => '1',
            'group' => 'admins',
        ]);

        Group::create([
            'group_id' => '1',
            'group' => 'admins',
            'group_id' => '2',
            'group' => 'users',
        ])->setDefault();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
