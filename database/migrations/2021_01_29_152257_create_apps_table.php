<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\WebApp;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('app_id');
            $table->string('app')->unique();
            $table->string('description')->nullable();
            $table->boolean('enabled')->default(true);
            $table->json('permissions')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        WebApp::create([
            'app' => 'web',
            'default' => true,
        ])->setDefault();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
