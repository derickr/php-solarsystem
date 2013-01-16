<?php
echo ";";
for ( $j = 0; $j < 86400; $j += 900 )
{
	printf( "%02d:%02d;", floor( $j / 3600), ($j % 3600) / 60 );
}
echo "\n";

$points = array(
	array( 'Johannesburg',  -26.20, 28.04 ),
	array( 'London',  51.50,    -0.127 ),
	array( 'Longyearbyen', 78.22, 15.63 ),
	array( 'Oslo', 59.91,  10.74 ),
);

foreach( $points as $info )
{
	list( $city, $lat, $lon ) = $info;

	echo "$city ({$lat}°, {$lon}°);";
	for ( $j = 0; $j <= 86400; $j += 900 )
	{
		$d = new DateTime( "2013-01-14 00:00 UTC" );
		$d->modify( "+$j seconds" );
		
		$ts = $d->format( "U" );
		printf( "%0.3f;", earth_sunpos( $ts, $lat, $lon ) );
	}
	echo "\n";
}
