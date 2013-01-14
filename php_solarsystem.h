#ifndef PHP_SOLARSYSTEM_H
#define PHP_SOLARSYSTEM_H

#include "php.h"

extern zend_module_entry solarsystem_module_entry;
#define phpext_solarsystem_ptr &solarsystem_module_entry

#ifdef PHP_WIN32
#define PHP_SOLARSYSTEM_API __declspec(dllexport)
#else
#define PHP_SOLARSYSTEM_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_FUNCTION(earth_sunpos);

#endif
