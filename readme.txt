=== Unhurried ===
Contributors: switchcasestudio
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.2.0
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
3. Open Appearance > About Unhurried (the notice on your dashboard links there). Its setup checklist shows what is done and what is left, with one button per step.
4. Click Create the homepage. The page opens with the full layout and the right template already chosen; change the words and photos, then publish it and pick it as your homepage under Settings > Reading. Every other page (About, Services, Contact, Work, Pricing, Visit, Topics, Journal) works the same way.

You can also do it by hand: create a page, choose the Ground artboard template, and pick the Homepage pattern when WordPress offers page patterns.

== Frequently Asked Questions ==

= Does the theme include a contact or booking form? =

Forms are plugin territory, so the theme works with the free ones you already know. With Contact Form 7 or WPForms Lite active, your first form appears in the card on the Contact page by itself, and the fields and button take on the theme's look. Fields from any other form plugin are styled too; place its block in the card. Developers can supply a form through the `unhurried_contact_form_block` filter.

= How do I add a newsletter signup? =

Install the free Newsletter plugin (wordpress.org/plugins/newsletter), which keeps subscribers in your own WordPress. Its email form then appears in the footer and in the Newsletter band pattern with no setup; run the plugin's short setup wizard to get its thank-you page and confirmation emails. Jetpack's Subscribe block works the same way. Without either, those spots offer your site's RSS feed. Developers can supply any other form through the `unhurried_newsletter_block` filter.

= How do I add my social profiles? =

Open the footer in the Site Editor, select each icon and paste your profile address. An icon without an address stays hidden from visitors, so you can leave the ones you don't use.

= How do I keep an image in color? =

Select the image and choose the Keep color style, or remove the `unhurried-mono` class from its parent block.

= A form field is hard to read in a dark look =

In the dark looks (Nocturne, Moss, Harbor, Plum, Lagoon, Dusk) the theme tells the browser the page is dark, so scrollbars, dropdown lists and fields the theme does not style turn dark too. A plugin field that sets only a white background, or only dark text, can then be hard to read. To keep the browser's light drawing, add this line to a small plugin or to a child theme's functions.php:

`add_filter( 'unhurried_dark_color_scheme', '__return_false' );`

WPForms Lite sets its own label colors for a light page. In the dark looks the theme gives its labels, notes and required marks the look's text colors; a form you style in the WPForms block keeps the colors you chose.

== Changelog ==

= 1.2.0 =
* Sample copy is Lorem Ipsum everywhere in the content patterns, so nothing reads as real until you write it. The header, footer, 404 and search screens keep real words.
* Motion throughout. Every section enters gently as it scrolls into view. Headings and text rise, photographs settle, and cards and list items follow one another. Figures count up, and the footer wordmark rises letter by letter. Buttons lift and press, menu underlines glide and accordions open smoothly. Cover photographs drift with the scroll, and pages cross-fade while the header stays put. Nothing moves for visitors who ask for reduced motion, and printing shows everything. The class unhurried-still keeps any block still.
* A marquee line above the header: the tagline and the newest posts drift slowly across an Ink strip. It pauses under the pointer and stands still for visitors who ask for reduced motion. It scrolls away; the header stays.
* Three more page patterns: Work (with a new Numbers section), Pricing and Visit.
* Nested services: nest pages under Services for addresses like /services/design/identity/. The Service group and Service page patterns read each page's own title and excerpt and add breadcrumbs. They list the pages under them as cards. The setup checklist has buttons for both.
* Footer: a newsletter row under the search, with the free Newsletter plugin's form or Jetpack's Subscribe block when active. Otherwise it offers the RSS feed. Social icons for Google Business Profile, Instagram, Facebook, X, Pinterest, TikTok, YouTube, LinkedIn and Yelp. An icon stays hidden from visitors until it has an address. The wordmark is in capitals, sized to fill the width, and rolls letter by letter on hover. A title in any alphabet shows whole, accents and emoji included. Your visitor's browser measures it as drawn.
* A setup checklist on Appearance > About Unhurried, with live progress. Every page opens ready-made with its layout and template; you review and publish it. Each step links straight to the right screen: settings, menus, footer, styles, plugins. A dashboard notice points to it until the site is set up.
* Contact Form 7 and WPForms: the first form appears in the Contact card by itself. Form fields from any plugin match the theme.
* Links to a spot on the page glide there and stop below the sticky header.
* Menu dropdowns are small rounded cards.
* Buttons and links that lead to a page name it: Contact us, Our services, Read the journal, Get directions. They held placeholder text.
* New homepage hero, Hero, statue: a full-screen photograph of Michelangelo's David in an inset, rounded frame. The headline, buttons and a caption sit over a soft shade.
* New hero, Hero, spiral: a round image that turns very slowly inside a ring of ticks. The headline's last word is set huge beside it. Motion stops when the visitor asks for reduced motion.
* Journal: breadcrumbs, topic chips with post counts (the current topic highlighted) and a search box for posts only. A results count, reading time on every card and post, and an author box. Related posts from the same topic, and a reading progress bar on posts.
* New Topics directory page pattern: every category as a card with its description and count, then every tag.
* New Essay pattern: long-form text with a drop cap, two columns and a pull quote. The Homepage pattern includes it.
* Footer: a search box, your topics and latest posts, the year and site name, and a back-to-top link. Columns that would be empty are left out.
* The header now stays at the top while you scroll. It was meant to since 1.0.0 but scrolled away.
* The header menu no longer shows Contact next to the Contact button; the open mobile menu still lists it.
* New sample images (CC0, from WordPress.org Photos).
* WooCommerce without Unhurried Pro: the cart, checkout and account pages read well in the dark looks. Those are Nocturne, Moss, Harbor, Plum, Lagoon and Dusk. The cart and checkout use WooCommerce's own dark fields there, so labels no longer vanish. Required marks and error messages are light enough to read. In every look the cart's quantity control has a clearer edge. The shop's layout stays Unhurried Pro's.
* Product pages: variation dropdowns show their whole text (the lower half was cut off).
* Until you make a menu of your own, the header and footer list every page. That automatic list now leaves out WooCommerce's Checkout page. It also leaves out Cart and My account when the header shows their icons. A menu you made is shown exactly as you saved it. A menu holding only an untouched Page List block counts as the automatic one. WordPress saves exactly that by itself. Choose a parent page for it, or add any link, and it is yours.
* The setup checklist works on sites in other languages. A page it opens is recognized whatever its title and address. So the Contact button turns on, and buttons lead to the right pages. "Set your menu" is done only when you have made a menu.
* Keyboard: the focus ring shows on every surface: the footer, glass cards, photographs and search fields. The two round search fields lost the soft glow inside their ring. The ring also shows on the site title and post pictures, where it was cut off. In Firefox, Shift+Tab no longer scrolls a control under the header. With a reader's own wider letter spacing, the footer wordmark gets smaller to fit.
* Screen readers: one header landmark instead of two. The header and footer menus are named "Main" and "Footer", and each search form has a name.
* Footer counts, dates and placeholders are easier to read, most of all in the dark looks.
* Dark looks get the browser's dark scrollbars and dropdown lists. Checkboxes and radio buttons stay white boxes, which stand out on a dark page in every browser.
* WPForms Lite in the dark looks: its labels, notes and required marks take the look's text colors. They were near-black on the dark page.
* Right-to-left languages: the header's inner spacing mirrors, and the footer wordmark reads in the right order. It stays whole, without the hover roll, on right-to-left sites. So do titles whose letters join or carry marks, such as Arabic, Hebrew and Hindi. Such a title underlines on hover, like the footer's other links.
* Motion: a form taller than the screen now appears, and numbers that count up end exactly as written ("1,200", "12,5"). Blocks marked unhurried-still are readable at once, and a header pattern placed inside a page stays still.
* Pages show sooner on phones. The first screen rises as soon as the page appears, without waiting for the motion script. Sample photographs further down a page load as you scroll toward them. A figure on the first screen shows its final number at once; figures further down still count up. The journal's results count rises with the rest of the screen.
* The heroes' italic word, the statue photograph and the spiral disc are faintly there from the first moment. They settle into place with the rest of the screen, instead of fading in from nothing.
* Hero, spiral: on wide screens the large italic word sits at the foot of the stage again. It had moved over the headline.
* Narrow phones: a long site title now shortens with an ellipsis, so the header button stays on screen. The page no longer scrolls sideways.
* Phones that do not need the full homepage photograph load a smaller copy, so it appears sooner. Desktops and tablets load the same photograph as before, and so does a phone held sideways. The photograph is never shown enlarged. Text keeps its lines when the theme's fonts arrive. Arrows and letters of other alphabets keep the system's font.
* Dark looks: text over photographs is light on a dark shade, as in the light looks. In the Statement and Services sections it had turned dark on dark, with a white button on a pale wash. Your own Covers follow the shade you gave them. On a dark color of your own at 60% or more, the text turns light. On the accent, another palette color or a light shade, it keeps its color. With an Ink scrim, a gradient of your own or a weak shade, your Covers look as in 1.1.1. On phones the right scrim becomes an even veil, and text on it turns light. So does text placed center right under a right scrim of 90% or more.
* Pages made with 1.1.1 keep their pictures. The 1.2.0 patterns use new pictures under new names.
* Small text over photographs is easier to read in every look. The label above a heading is at full strength, and the Services section's shade is a little deeper.
* With a child theme, an update of Unhurried reaches browsers straight away (its stylesheet and script carry Unhurried's own version).
* About Unhurried: the Unhurried Pro card and notice name what Pro adds to the shop pages. They list a header band, 4:5 product photos and a summary that follows the page. They also list a checkout with nothing else on it. They state no price and open their links in a new tab. The setup checklist's plugin buttons are whole phrases for translators.
* Under the hood: the theme's PHP files do nothing when opened directly. Block settings printed from PHP stay intact whatever a translation holds. The About screen's styles load with the other admin styles, and the code passes the WordPress coding standards.

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
* About Unhurried: a card about Unhurried Pro, a Plugins that fit card (WooCommerce, Contact Form 7, Newsletter, ReviewScribe; installing is always your own click), and a one-line review ask.
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
assets/images/david-1200.webp and assets/images/david-800.webp: smaller copies of david.webp, made from the same photograph for phones. Same source and license (CC0).
assets/images/spiral.webp: Bango Renders, https://stocksnap.io/photo/abstract-shapes-AGYUJILSQ2
assets/images/flower-vase.webp: Imani Clovis, https://stocksnap.io/photo/flower-vase-CTW7WOGRO6
assets/images/vase-niche.webp: Tawhid Sadman, https://wordpress.org/photos/photo/46569db992/
assets/images/vine-wall.webp: creativemz, https://wordpress.org/photos/photo/38665f56ad/
assets/images/desert-dune.webp: Samuel Scrimshaw, https://stocksnap.io/photo/nature-desert-UV4PIZ1DEK
assets/images/maple-leaves.webp: Bob Richards, https://stocksnap.io/photo/tree-branch-D74M8ZEETS
assets/images/autumn-still-life.webp: Altered Reality, https://stocksnap.io/photo/autumn-minimalist-U9FDQVP6HZ
assets/images/pink-vase.webp: Chimene Gaspar, https://stocksnap.io/photo/vase-wall-JGTJS8KF6Q

assets/images/arch.webp, branch-shadow.webp, drape.webp, light-window.webp, orb.webp, pedestal.webp, vessel.webp: the pictures of Unhurried 1.1.1, kept for pages made with it.
Created for this theme by the theme author, generated from original code.
License: CC0 1.0 Universal, https://creativecommons.org/publicdomain/zero/1.0/

Screenshot
screenshot.png is composed from the theme's own patterns and images above.
License: CC0 1.0 Universal, https://creativecommons.org/publicdomain/zero/1.0/
