<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("events", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("place");
            $table->text("image");
            $table->date("date");
            $table->text("time");
            $table->text("description");
            $table->integer("user_id")->unsigned();
            $table->timestamps();
        });

        Schema::table("events", function ($table) {
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("restrict")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("events");
    }
}
