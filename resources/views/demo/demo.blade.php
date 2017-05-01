@foreach($houses as $house)
<?php
foreach ($locations as $location) {
	# code...
	if ($location->id==$house->location_id) {
		# code...
		$locationName = $location->location;
		$countyId = $location->county_id;
		break;
	}
}
foreach ($counties as $county) {
	# code...
	if($county->id== $countyId){
		$countyName = $county->county;
		break;
	}
}
  ?>
@endforeach