# Changelog

All notable changes to the free Unhurried theme.

## 1.1.0 (2026-11-06)
- About Unhurried: a Pro card (three copy variants, picked by the `UNHURRIED_PRO_VARIANT` constant), a Plugins that fit card (WooCommerce, Contact Form 7, ReviewScribe; three layouts by `UNHURRIED_PLUGINS_VARIANT`; `UNHURRIED_SHOW_REVIEWSCRIBE` pulls that entry; installing is always the user's click; the setup guide's affiliate links are disclosed), and a one-line review ask. Data and copy are filterable (`unhurried_recommended_plugins`, `unhurried_pro_card`).
- Two notices through `admin_notices`, each with a nonce-protected, permanent "Not now", shown only on the Dashboard, Themes and About screens, one at a time: Unhurried Pro when WooCommerce is active and Pro is not installed; a review ask after 14 days (`unhurried_notice_days` filter). The 14-day clock starts on activation or, for sites updating from 1.0.x, on the first admin visit after the update.
- Admin notices land below the About screen's welcome hero (`wp-header-end`).
- Reveal on scroll is a block style (`is-style-reveal`) on Group, Columns, Column, Image, Heading, Paragraph, Cover and Quote. The `unhurried-reveal` class still works and is still needed on blocks that carry another style.
- Pattern buttons link to the Contact and Services pages when those pages exist (`unhurried_page_link()`); the contact card button is a mailto link. No more `#` links.
- Header patterns: centred title (navigation left, title centre, button right) and quiet (logo, title, one button).
- Patterns: opening hours card, newsletter Ink band, names strip. New helper classes `unhurried-hours`, `unhurried-names`, `unhurried-dim`.
- Style variation: Mist (cool paper, slate ink, ochre accent; all pairs pass WCAG AA).
- Dev: `dev/blueprint-woo.json` boots Playground with WooCommerce active and the free theme alone.

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
