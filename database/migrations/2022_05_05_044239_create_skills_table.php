<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('skills', function (Blueprint $table) {
      $table->id();
      $table->text("name");
      $table->string("image");
      $table->foreignId("cat_id")->constrained()->onUpdate("cascade")->onDelete("cascade");
      $table->boolean("active")->default(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('skills');
  }
}
