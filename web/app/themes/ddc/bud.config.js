/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/sage/docs sage documentation}
 * @see {@link https://bud.js.org/learn/config bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
export default async(app) => {
  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/reference/bud.entry}
   * @see {@link https://bud.js.org/reference/bud.assets}
   */
    app
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .entry('home', ['@scripts/pages/home', '@styles/pages/home'])
    .entry('region', ['@scripts/pages/notre-region', '@styles/pages/notre-region'])
    .entry('contact', ['@scripts/pages/contact', '@styles/pages/contact'])
    .entry('domaine', ['@scripts/pages/domaine', '@styles/pages/domaine'])
    .entry('gites', ['@scripts/pages/nos-gites', '@styles/pages/nos-gites'])
    .entry('mentions', ['@scripts/pages/mentions', '@styles/pages/mentions'])
      .entry('singlegites', ['@scripts/pages/single-gite', '@styles/pages/single-gite'])

    .assets(['images']);

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/reference/bud.setPublicPath}
   */
    app.setPublicPath('/app/themes/ddc/public/');

  /**
   * Development server settings
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
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
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
    })
};
