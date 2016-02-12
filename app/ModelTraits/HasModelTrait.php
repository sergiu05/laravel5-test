<?php

namespace App\ModelTraits;

use Carbon\Carbon;

trait HasModelTrait {

	public function showDateCreated($createdAtTimestamp) {
		return Carbon::parse($createdAtTimestamp)->format('d/m/Y');
	}
}