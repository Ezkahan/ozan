<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class ModalBannerRepositoriesTable.
 */
class ModalBannerRepositoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('../_webkul/_admin/src/_repositories/_modal_banner_repositories', function(Blueprint $table) {
            $table->increments('id');

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
		Schema::drop('../_webkul/_admin/src/_repositories/_modal_banner_repositories');
	}
}
