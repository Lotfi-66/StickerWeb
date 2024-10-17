/**
 * Configuration du compilateur
 *
 * @see {@link https://roots.io/sage/docs documentation sage}
 * @see {@link https://bud.js.org/learn/config guide de configuration bud.js}
 *
 * @type {import('@roots/bud').Config}
 */
export default async (app) => {
  /**
   * Assets de l'application et points d'entrée
   *
   * @see {@link https://bud.js.org/reference/bud.entry}
   * @see {@link https://bud.js.org/reference/bud.assets}
   */
  app
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .assets(['images']);

  /**
   * Définir le chemin public
   *
   * @see {@link https://bud.js.org/reference/bud.setPublicPath}
   */
  app.setPublicPath('/app/themes/stickersWeb/public/');

  /**
   * Paramètres du serveur de développement
   *
   * @see {@link https://bud.js.org/reference/bud.setUrl}
   * @see {@link https://bud.js.org/reference/bud.setProxyUrl}
   * @see {@link https://bud.js.org/reference/bud.watch}
   */
  app
    .setUrl('http://localhost:3000')
    .setProxyUrl('http://localhost:8000')
    .watch(['resources/views', 'app']);

  /**
   * Générer le `theme.json` de WordPress
   *
   * @note Ceci écrase `theme.json` à chaque build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .setSettings({
      background: {
        backgroundImage: true,
      },
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
      },
      custom: {
        spacing: {},
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      spacing: {
        padding: true,
        units: ['px', '%', 'em', 'rem', 'vw', 'vh'],
      },
      typography: {
        customFontSize: false,
      },
    });

  /**
   * Configurer les alias pour des imports plus faciles
   */
  app.alias({
    '@scripts': app.path('@src/scripts'),
    '@styles': app.path('@src/styles'),
  });

  /**
   * Configurer Babel
   */
  app.babel((config) => {
    config.presets.push('@babel/preset-env');
    return config;
  });

  /**
   * Configurer PostCSS
   */
  app.postcss((config) => {
    config.plugins.push(
      require('autoprefixer'),
      require('postcss-preset-env')({
        stage: 3,
        features: {
          'nesting-rules': true,
        },
      })
    );
    return config;
  });

  /**
   * Configurer Webpack
   */
  app.webpack((config) => {
    // Ajoutez ici toute configuration webpack personnalisée si nécessaire
    return config;
  });

  return app;
};