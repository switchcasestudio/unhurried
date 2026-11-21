=== Unhurried ===
Contributors: switchcasestudio
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.1.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A calm, editorial block theme for studios, clinics, spas and makers who sell care rather than speed.

== Description ==

Unhurried gives a small business the feel of a printed lookbook. Warm Bone and Ink surfaces, floating panels that rise over the section above, oversized display type with italic accent words, and a gallery-monochrome image treatment keep every page quiet and considered.

Write an italic word inside any heading and it turns into the Fraunces accent face, so the signature look works everywhere without extra settings.

The theme includes:

* Full-page patterns for a homepage, about, services and contact page.
* Heroes (a full-screen image in an inset frame, a full-height stage with a slowly turning round image, staggered type, split with an arched image, type only), a rising "your visit" panel, services on an image with a frosted accordion, a staggered gallery, a values statement, a stories grid, a testimonial, a call to action, a price list, membership tiers, questions and answers, contact details and a team feature.
* Section styles for any Group: Panel, Card, Ink, Ground and Glass.
* Block styles: Eyebrow and Statement paragraphs, Hairline and Text link buttons, and Arch and Keep color images.
* A blog with a staggered stories grid, category and tag archives, and split-hero single posts with comments.
* Nineteen style variations under Styles in the Site Editor. Eight color themes with three or four hues each: Orchard, Tide, Saffron, Lagoon, Rosewater, Studio, Terrace and Dusk. Ten tinted papers with one ink and one accent: Nocturne, Linen, Mist, Moss, Harbor, Plum, Clay, Blush, Olive and Cobalt. And Folio, which keeps the colors and sets headings in Fraunces italic. Every text pair in every look passes WCAG AA.
* Two page templates without a title: Canvas and Ground artboard. Use Ground artboard with the Homepage pattern.
* A small, optional reveal-on-scroll effect. Choose the Reveal on scroll block style, or add the class `unhurried-reveal` to any block. It is switched off for visitors who prefer reduced motion, and content stays visible without JavaScript.
* Add the class `unhurried-mono` to any block to show its images in grayscale.

* Two header patterns: centered title, and quiet (no navigation).
* A journal with breadcrumbs, topic chips, a posts-only search, reading time, related posts, an author box and a reading progress bar, plus a Topics directory page pattern and a long-form Essay pattern.
* An opening hours card, a newsletter band, a names strip for stockists or press, story rows, a gift card, a map and directions section, a quiet footer, and a footer with visit details for your address and email.
* An About Unhurried screen under Appearance, with getting-started steps, credits, a short list of plugins that fit, and a note about Unhurried Pro, the paid child theme that styles WooCommerce. The screen links to a setup guide on switchcasestudio.com; some links on that guide are affiliate links.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click Add New.
2. Search for Unhurried, then click Install and Activate.
3. Create a page, choose the Ground artboard template, and pick the Homepage pattern when WordPress offers page patterns.
4. Set that page as your homepage under Settings > Reading.

== Frequently Asked Questions ==

= Does the theme include a contact or booking form? =

No. Forms are plugin territory. The Contact pattern has a card where you can drop in the block from any form or booking plugin.

= How do I keep an image in color? =

Select the image and choose the Keep color style, or remove the `unhurried-mono` class from its parent block.

== Changelog ==

= 1.2.0 =
* Sample copy is Lorem Ipsum everywhere in the content patterns, so nothing reads as real until you write it. The header, footer, 404 and search screens keep real words.
* A marquee line above the header: the tagline and the newest posts drift slowly across an Ink strip, pause under the pointer, and stand still for visitors who ask for reduced motion. It scrolls away; the header stays.
* Three more page patterns: Work (with a new Numbers section), Pricing and Visit.
* Footer: a newsletter row under the search (Jetpack's Subscribe block when it is active, otherwise the RSS feed), social icons for Google Business Profile, Instagram, Facebook, X, Pinterest, TikTok, YouTube, LinkedIn and Yelp (an icon stays hidden from visitors until it has an address), and the wordmark in capitals, sized to fill the width, rolling letter by letter on hover.
* Menu dropdowns are small rounded cards.
* New homepage hero, Hero, statue: a full-screen photograph of Michelangelo's David in an inset, rounded frame, with the headline, buttons and a caption over a soft shade.
* New hero, Hero, spiral: a round image that turns very slowly inside a ring of ticks, with the headline's last word set huge beside it. Motion stops when the visitor asks for reduced motion.
* Journal: breadcrumbs, topic chips with post counts (the current topic highlighted), a search box that looks only through posts, a results count, reading time on every card and post, an author box, related posts from the same topic, and a reading progress bar on posts.
* New Topics directory page pattern: every category as a card with its description and count, then every tag.
* New Essay pattern: long-form text with a drop cap, two columns and a pull quote. The Homepage pattern includes it.
* Footer: a search box, your topics and latest posts, the year and site name, and a back-to-top link. Columns that would be empty are left out.
* The header now stays at the top while you scroll. It was meant to since 1.0.0 but scrolled away.
* The header menu no longer shows Contact next to the Contact button; the open mobile menu still lists it.
* New sample images (CC0, from WordPress.org Photos).

= 1.1.2 =
* Nine fixes found by visiting the live sites that use Unhurried. A site whose header and footer were never edited now shows nothing fake.
* Footer: the lead line is your site tagline (Settings > General) instead of "Take your time.", and the sample address and email are gone. The address layout is now the Footer with visit details pattern.
* Footer wordmark: a long site title shrinks to fit instead of being cut off, also in footers you have edited. Letters that hang below the line (g, j, p, q, y) are no longer clipped.
* Header button: shown only when you have a published page at /contact/, and labeled with that page's title. Blogs no longer show "Book a visit" linked to nowhere.
* Blog heading: shows your posts page title, your tagline or your site name instead of "Notes on craft".
* Homepage: on a static front page using the default Pages template, the large page title ("Home") above your content is gone. Inner pages keep their titles.
* Header menu: with eight or more links (or no menu chosen, which lists every page) the header shows the menu button at every width instead of wrapping to two rows; between 600 and 1024 pixels wide it does so from five links.
* Right-to-left sites: English lines in the header and footer keep their punctuation at the end, and a long site title is cut at its end. Spacing rules now use start and end, not left and right.
* Email links in footer columns shrink to fit the column instead of breaking mid-word.

= 1.1.1 =
* American English throughout: the Harbor look, the Header, centered title pattern and the Keep color image style carry their American names now. Images already set to the old image style keep working.

= 1.1.0 =
* About Unhurried: a card about Unhurried Pro, a Plugins that fit card (WooCommerce, Contact Form 7, ReviewScribe; installing is always your own click), and a one-line review ask.
* Two notices, each permanently dismissible, shown only on the Dashboard, Themes and About screens: Unhurried Pro when WooCommerce is active and Pro is not; a review ask after 14 days.
* Reveal on scroll is now a block style for Group, Columns, Column, Image, Heading, Paragraph, Cover and Quote. The class still works.
* Pattern buttons link to your Contact and Services pages when those pages exist.
* Header patterns: centered title; quiet (no navigation).
* Patterns: opening hours card, newsletter band, names strip, story rows, gift card, map and directions, quiet footer.
* Seventeen new style variations: eight color themes (Orchard, Tide, Saffron, Lagoon, Rosewater, Studio, Terrace, Dusk), eight tinted papers (Mist, Moss, Harbor, Plum, Clay, Blush, Olive, Cobalt) and Folio (serif italic headings).
* Fixed: text inside the Glass style was unreadable in Nocturne.
* Fixes: hairline buttons on dark sections keep their pill on hover; the services index keeps prices on one line on phones; no stray line above the first accordion row.

= 1.0.2 =
* Sticky footer on pages shorter than the window.
* Selected text is visible on dark sections (translucent accent highlight).
* The Position > Sticky block option is hidden; the header capsule stays sticky.
* Theme URI added.

= 1.0.1 =
* Credits use the author's canonical name, Moses Atia Poston.

= 1.0.0 =
* Initial release.

== Copyright ==

Unhurried WordPress Theme, (C) 2026 Moses Atia Poston, Switch Case Studio.
Unhurried is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

== Resources ==

Hanken Grotesk
Copyright 2021 The Hanken Grotesk Project Authors (https://github.com/marcologous/hanken-grotesk)
License: SIL Open Font License, Version 1.1, https://openfontlicense.org

Inter
Copyright 2016 The Inter Project Authors (https://github.com/rsms/inter)
License: SIL Open Font License, Version 1.1, https://openfontlicense.org

Fraunces
Copyright 2020 The Fraunces Project Authors (https://github.com/undercasetype/Fraunces)
License: SIL Open Font License, Version 1.1, https://openfontlicense.org

Images
Photographs from StockSnap.io, the WordPress.org Photo Directory and the Rijksmuseum, cropped for this theme. Patterns show most of them in grayscale.
License: CC0 1.0 Universal, https://creativecommons.org/publicdomain/zero/1.0/

assets/images/david.webp: Edizione Brogi, Particolare del David di Michelangelo (Florence, about 1880), Rijksmuseum, https://commons.wikimedia.org/w/index.php?curid=85189300
assets/images/spiral.webp: Bango Renders, https://stocksnap.io/photo/abstract-shapes-AGYUJILSQ2
assets/images/arch.webp: Imani Clovis, https://stocksnap.io/photo/flower-vase-CTW7WOGRO6
assets/images/pedestal.webp: Tawhid Sadman, https://wordpress.org/photos/photo/46569db992/
assets/images/branch-shadow.webp: creativemz, https://wordpress.org/photos/photo/38665f56ad/
assets/images/drape.webp: Samuel Scrimshaw, https://stocksnap.io/photo/nature-desert-UV4PIZ1DEK
assets/images/light-window.webp: Bob Richards, https://stocksnap.io/photo/tree-branch-D74M8ZEETS
assets/images/orb.webp: Altered Reality, https://stocksnap.io/photo/autumn-minimalist-U9FDQVP6HZ
assets/images/vessel.webp: Chimene Gaspar, https://stocksnap.io/photo/vase-wall-JGTJS8KF6Q

Screenshot
screenshot.png is composed from the theme's own patterns and images above.
License: CC0 1.0 Universal, https://creativecommons.org/publicdomain/zero/1.0/
