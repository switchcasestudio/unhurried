# Changelog

All notable changes to the free Unhurried theme.

## 1.0.2 (2026-10-30)
- Sticky footer: on a page shorter than the window (a 404, a one-screen landing) the footer now sits at the bottom of the window instead of leaving the page background showing under it. `.wp-site-blocks` is a column flexbox of at least one viewport and `main` grows.
- Selected text is visible on dark sections: the selection highlight is now a translucent accent tint. Before, selecting text on an Ink section or a dark footer painted it in the section's own colors, so it looked as if nothing could be selected.
- The Position > Sticky block option is hidden (`theme.json`). A visitor's site had set a whole section sticky by accident, and it slid over everything below it. The header capsule stays sticky through the theme's own CSS.
- `Theme URI` added (https://switchcasestudio.com/projects/unhurried), so the WordPress.org listing links the theme's page.

## 1.0.1 (2026-09-25)
- Credits and copyright now use the canonical name **Moses Atia Poston** (the byline used on switchcasestudio.com and GitHub).

## 1.0.0 (submitted to WordPress.org 2026-09-25, review ticket https://themes.trac.wordpress.org/ticket/292908)

### 2026-09-24
- Built as a WordPress block theme from Switch Case Studio's light editorial design.
- 27 patterns: homepage, about, services and contact pages; staggered, split and type heroes; visit panel; services accordion on image; staggered gallery; values statement; stories grid; testimonial; call to action; price list; membership tiers; FAQ; contact details; team feature.
- Section styles (Panel, Card, Ink, Ground, Glass), block styles (Eyebrow, Statement, Hairline, Text link, Arch, Keep colour) and two style variations (Nocturne, Linen).
- Neutral "rest and ritual" demo copy; seven original CC0 still-life images; OFL fonts (Hanken Grotesk, Inter, Fraunces).
- Author credit: "Designed by Switch Case Studio" in the footer.
- Appearance > About Unhurried: getting-started steps, tips, and a Credits panel naming Moses Atia Poston of Switch Case Studio, with copyright and licence.
- Author and copyright headers in functions.php and every pattern file.
- Fixed: the stylesheet now loads from the parent theme, so child themes (Unhurried Pro) keep the header, panel and reveal styles.
- Fixed: the header button no longer wraps on phones; the site title truncates instead.
- Moved WooCommerce templates and the lead-story pattern to Unhurried Pro.
- Checks: Theme Check clean; every pattern and template block-valid in WordPress 7.1.2; no horizontal overflow at 320–1440 px.

## Development

`dev/serve.sh free|pro` starts a WordPress Playground demo on port 9400 (Pro expects `../unhurried-pro`). `dev/validate.cjs` checks block validity; `dev/themecheck.cjs` runs Theme Check.
