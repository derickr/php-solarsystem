PHP_ARG_ENABLE(solarsystem, whether to enable solarsystem support,
[  --enable-solarsystem          Enable solarsystem support])

if test "$PHP_SOLARSYSTEM" != "no"; then
  PHP_NEW_EXTENSION(solarsystem, solarsystem.c astrolib/astro.c, $ext_shared)
  PHP_ADD_BUILD_DIR($ext_builddir/astrolib, 1)
fi
