<?php

namespace App\ModelTraits;

use Carbon\Carbon;

trait HasModelTrait {

	public function showDateCreated($createdAtTimestamp) {
		return Carbon::parse($createdAtTimestamp)->format('d/m/Y');
	}

	public function showStatusOf($record) {
		switch($record->status_id) {
			case 10:
				return 'Active';
				break;
			case 7:
				return 'Inactive';
				break;
			default:
				return 'Inactive';
				break;
		}
	}
}