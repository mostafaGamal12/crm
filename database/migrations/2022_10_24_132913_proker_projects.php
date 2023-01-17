<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_projects', function (Blueprint $table) {
            $table->foreignId("project_id")->constrained("projects");
            $table->foreignId("broker_id")->constrained('brokers');
            $table->float("commission");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broker_projects');
        Schema::dropForeign('broker_id');
        Schema::dropForeign('project_id');
    }
};