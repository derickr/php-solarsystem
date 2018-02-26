<?php
date_default_timezone_set( "UTC" );
$lat = 51.53;
$lon = -0.09;

$dateStart = new DateTimeImmutable( "2018-01-01 07:00" );
$dateEnd   = $dateStart->modify( "+1 year 1 day" );
$dateInterval = new DateInterval( "P1D" );

foreach ( new DatePeriod( $dateStart, $dateInterval, $dateEnd ) as $date )
{
	echo $date->format( DateTimeImmutable::ISO8601 ), ",";
	$sunInfo = date_sun_info( $date->format( 'U' ), $lat, $lon );
	echo $date->format( 'U' ), ",";
	echo $sunInfo['transit'], ",";
	echo $sunInfo['transit'] - ( $date->format( 'U' ) ), ",";
	echo earth_sunpos( ( $date->format( 'U' ) ), $lat, $lon )['azimuth'], ",";
	echo earth_sunpos( ( $date->format( 'U' ) ), $lat, $lon )['altitude'], "\n";
}
die();

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
