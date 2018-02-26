#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_solarsystem.h"
#include "astrolib/astro.h"
#include "ext/standard/info.h"

#ifdef COMPILE_DL_SOLARSYSTEM
ZEND_GET_MODULE(solarsystem)
#endif

PHP_FUNCTION(earth_sunpos)
{
	long ts; /* unix timestamp */
	double lat, lon;
	double L, ra, decl, rad, sidtime, ha, M; /* temp vars */
	double azimuth, altitude;
	double daynr; /* In 2000 Jan 0.0 Epoch */

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "ldd", &ts, &lat, &lon) == FAILURE) {
		return;
	}
	daynr = (ts - 946598400) / 86400.0;
	sunpos(daynr, &L, &M, &ra, &decl, &rad);
	sidtime_and_ha(L, (daynr - floor(daynr)) * 24, lon, ra, &sidtime, &ha);
	sunaltazimuth(L, lat, ha, decl, &azimuth, &altitude);

	array_init(return_value);
	add_assoc_double(return_value, "altitude", altitude);
	add_assoc_double(return_value, "azimuth", azimuth);
}

zend_function_entry solarsystem_functions[] = {
	PHP_FE(earth_sunpos, NULL)
	{NULL, NULL, NULL}
};

zend_module_entry solarsystem_module_entry = {
	STANDARD_MODULE_HEADER,
	"solarsystem",
	solarsystem_functions,
	NULL, NULL, NULL, NULL, NULL,
	"0.0.1",
	STANDARD_MODULE_PROPERTIES
};
