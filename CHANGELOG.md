# Changelog

All notable changes to the free Unhurried theme.

## 1.1.2 (2026-11-19)

Nine fixes found by visiting the 13 live sites that use the theme (2026-11-19). Most sites never edit the header and footer, so whatever the theme prints there goes live as it stands. Plan: `docs/internal/2026-11-19-free-1.1.2-plan.md`.

- Footer with wordmark (`unhurried/footer`): the "Take your time." heading and the Visit column (sample address and `hello@example.com`) are gone. The site tagline is the lead line (`unhurried-footer-lead`: display face, x-large, 24ch, balanced); with no tagline only the Explore column shows. Footer, quiet loses its Visit column too.
- New pattern **Footer with visit details** (`unhurried/footer-visit`): the 1.1.1 layout, for sites that want an address column. Its email is a `mailto:` link, as is the one in Contact, split.
- Wordmark: `unhurried_size_wordmark()` (`render_block_core/site-title`) puts the title's estimated width in em on the element as `--unhurried-wordmark-em`, from glyph widths measured off the bundled Hanken Grotesk (`unhurried_wordmark_em_width()`); `style.css` caps the size at the column width divided by it. Titles up to about twelve characters keep the 15vw size, so "Unhurried" is unchanged. Reaches footers saved before 1.1.2 (they carry the class). `overflow-x: clip` replaces `overflow: hidden`, so descenders are no longer cut.
- Header button (`unhurried/header-button`): printed only when a published page with the slug `contact` exists, labeled with its title. Before, it read "Book a visit" and linked to `#` on sites without that page. Unhurried Pro's header uses the same pattern.
- Blog heading (`unhurried/hidden-blog-heading`): the posts page title with the site name as the eyebrow, else the tagline, else the site name alone; over 32 characters it steps down to xx-large. "Stories" and "Notes on craft" are removed.
- Pages template: the title band is `unhurried-page-head`; `unhurried_hide_front_page_head()` drops it on a static front page (filter `unhurried_hide_front_page_title` to keep it). Templates edited before 1.1.2 lack the class and are unchanged.
- Header menu: from eight top-level links (or the page-list fallback with eight pages) the capsule keeps the menu button at every width; below 1024px from five.
- Right-to-left: header and footer lines use `unicode-bidi: plaintext` and align to the start on `.rtl` sites (zero specificity). `.unhurried-indent`, `.unhurried-step`, `.unhurried-note`, the map note, the centered header's navigation and the search button use logical properties.
- Email links in footer columns: `font-size: max(.8125rem, min(1em, 6.5cqi))`, wrapping only below the 13px floor.

## 1.1.1 (2026-11-08)

- American English throughout. The **Harbor** look (`styles/harbor.json`), the **Header, centered title** pattern (`unhurried/header-centered`) and the **Keep color** image style (`is-style-color`) carry their American names now; the old image-style class from 1.0.x still works. Comments, readme and the About screen follow.

## 1.1.0 (2026-11-06)
- About Unhurried: a Pro card (three copy variants, picked by the `UNHURRIED_PRO_VARIANT` constant), a Plugins that fit card (WooCommerce, Contact Form 7, ReviewScribe; three layouts by `UNHURRIED_PLUGINS_VARIANT`; `UNHURRIED_SHOW_REVIEWSCRIBE` pulls that entry; installing is always the user's click; the setup guide's affiliate links are disclosed), and a one-line review ask. Data and copy are filterable (`unhurried_recommended_plugins`, `unhurried_pro_card`).
- Two notices through `admin_notices`, each with a nonce-protected, permanent "Not now", shown only on the Dashboard, Themes and About screens, one at a time: Unhurried Pro when WooCommerce is active and Pro is not installed; a review ask after 14 days (`unhurried_notice_days` filter). The 14-day clock starts on activation or, for sites updating from 1.0.x, on the first admin visit after the update.
- Admin notices land below the About screen's welcome hero (`wp-header-end`).
- Reveal on scroll is a block style (`is-style-reveal`) on Group, Columns, Column, Image, Heading, Paragraph, Cover and Quote. The `unhurried-reveal` class still works and is still needed on blocks that carry another style.
- Pattern buttons link to the Contact and Services pages when those pages exist (`unhurried_page_link()`); the contact card button is a mailto link. No more `#` links.
- Header patterns: centered title (navigation left, title center, button right) and quiet (logo, title, one button).
- Patterns: opening hours card, newsletter Ink band, names strip. New helper classes `unhurried-hours`, `unhurried-names`, `unhurried-dim`.
- Style variations, seventeen new ones, every text pair measured against WCAG AA (4.5:1 for text and muted text on paper, ground and band; 3:1 for the accent; 4.5:1 for paper on the accent button hover):
  - Eight color themes with three or four hues spread across the hero band (`ground`), the quiet bands (`base-2`), the dark sections (`contrast`) and the accent: Orchard, Tide, Saffron, Lagoon, Rosewater, Studio, Terrace, Dusk.
  - Eight tinted papers with one ink and one accent: Mist, Moss, Harbor, Plum, Clay, Blush, Olive, Cobalt.
  - Folio, which keeps the colors and swaps the heading face.
- Text selection tint now follows the accent (`color-mix`, terracotta rgba as the fallback), so colored looks do not select in terracotta.
- Dev: `dev/blueprint-woo.json` boots Playground with WooCommerce active and the free theme alone.
- Patterns: story rows (three alternating image and text rows, image first on phones), gift card (an Ink card drawn from the site title, at credit-card proportions, beside the pitch and price), map and directions (address, travel notes, a Get directions button and a drawn map placeholder with a pin and a glass note), and a quiet footer without the wordmark. New helper classes `unhurried-story`, `unhurried-giftcard`, `unhurried-map`.
- Style variation: Folio. Headings set in Fraunces italic, with the accent word flipped to upright Hanken Grotesk; h4 to h6, buttons, navigation and the wordmark stay sans. Colors unchanged.
- Fixed: the Glass style's text is always Bone now. In Nocturne it inherited the inverted base color and became Ink on dark glass, so the frosted accordion and the note cards on covers were unreadable (a 1.0 bug).
- Second pixel pass, against the contrast and touch checklists: the Text link button's hover color is the accent pulled 20% toward Ink (`color-mix`, accent as the fallback), so it clears 4.5:1 on Bone instead of 3.96:1; navigation links underline on hover and keyboard focus (they had no hover state); vertical menus give each link `.35rem` of vertical padding, so footer links are 33px tall on a phone instead of 22px, with the footers' menu gap tightened to keep the rhythm; the map note's glass is darker (`.86`) so its 12px eyebrow clears 4.5:1 over Stone.
- Polish after a pixel review: Hairline buttons on Ink sections now fill Bone on hover instead of vanishing Ink-on-Ink; the services index keeps "From $180" on one line on phones (price column 6rem, thumbnail 56px); the frosted accordion no longer draws a stray hairline above its first row; the hours card leads with "The door is open" and shows times in Ink; the About screen's second row of cards hugs its content.

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
- Section styles (Panel, Card, Ink, Ground, Glass), block styles (Eyebrow, Statement, Hairline, Text link, Arch, Keep color) and two style variations (Nocturne, Linen).
- Neutral "rest and ritual" demo copy; seven original CC0 still-life images; OFL fonts (Hanken Grotesk, Inter, Fraunces).
- Author credit: "Designed by Switch Case Studio" in the footer.
- Appearance > About Unhurried: getting-started steps, tips, and a Credits panel naming Moses Atia Poston of Switch Case Studio, with copyright and license.
- Author and copyright headers in functions.php and every pattern file.
- Fixed: the stylesheet now loads from the parent theme, so child themes (Unhurried Pro) keep the header, panel and reveal styles.
- Fixed: the header button no longer wraps on phones; the site title truncates instead.
- Moved WooCommerce templates and the lead-story pattern to Unhurried Pro.
- Checks: Theme Check clean; every pattern and template block-valid in WordPress 7.1.2; no horizontal overflow at 320–1440 px.

## Development

`dev/serve.sh free|pro` starts a WordPress Playground demo on port 9400 (Pro expects `../unhurried-pro`). `dev/validate.cjs` checks block validity; `dev/themecheck.cjs` runs Theme Check.
