<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fakturs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("user_id");
      $table->string("invoice")->unique();
      $table->string("receiver_address");
      $table->string("receiver_postal_code");
      $table->integer("total");
      $table->timestamps();
      $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('fakturs');
  }
};
