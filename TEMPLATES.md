# Template map

This theme used to render through Elementor Theme Builder. Every one of those
templates is now a native PHP template in this folder. Nothing on the front end
loads Elementor any more.

## Where each Elementor template went

| Elementor template | ID | Now lives in |
| --- | --- | --- |
| Global Header | 12 | `header.php` |
| Global Footer | 270 | `footer.php` |
| Mobile Nav (popup) | 1335 | `template-parts/mobile-nav.php` + `js/mobile-nav.js` |
| Homepage | 40 | `front-page.php` |
| About us | 760 | `page-about-us.php` |
| Contact us | 794 | `page-contact-us.php` |
| Mic Products | 982 | `page-micromeritics-products.php` |
| Support page | 1042 | `page-support.php` |
| Policies Template | 993 | `page.php` (default for all pages) |
| Single Article | 229 | `single-article.php`, included by `single-applications.php`, `single-resources.php`, `single-features.php` |
| Single Product | 281 | `single-product.php` |
| Accessories (single) | 1132 | `single-accessories.php` |
| Resource Archive | 483 | `archive-resources.php` |
| Products Archive | 657 | `archive-product.php` |
| Applications Archive | 925 | `archive-applications.php` |
| Accessories Archive | 1107 | `archive-accessories.php` |
| Error 404 | 1079 | `404.php` |

### Loop item templates → card partials

| Elementor loop item | ID | Partial |
| --- | --- | --- |
| Resources Home card | 83 | `template-parts/cards/card-resource.php` |
| Card with Feature image | 187 | `template-parts/cards/card-feature.php` |
| Related resource Card | 536 | `template-parts/cards/card-related.php` |
| Product Card | 666 | `template-parts/cards/card-product.php` |
| Accessories loop card | 1109 | `template-parts/cards/card-accessory.php` |

### Custom code snippets

| Snippet | ID | Now lives in |
| --- | --- | --- |
| Optimole | 44 | `inc/third-party.php` |
| Articles (CSS) | 463 | `assets/css/ft-article.css` |
| Back To Top | 591 | `template-parts/back-to-top.php` + `js/ft-back-to-top.js` |

The FT4 product page's interactive chart (an Elementor HTML widget) is now
`template-parts/powder-chart.php`, `assets/css/ft-powder-chart.css` and
`js/ft-powder-chart.js`.

## Styles

`assets/css/ft-base.css` holds the design tokens, taken 1:1 from the old
Elementor Global Kit:

- Freeman Blue `#005DBE`, Secondary `#54595F`, Text `#000000`,
  Accent Grey `#E8E8E8`, Accent Blue `#F2F6F8`
- Inter / Inter Tight / Roboto, with the kit's named sizes
- 1440px container, stepping to 1280 / 1024 / 767 at the same breakpoints
  Elementor used (1366 laptop, 1024 tablet, 767 mobile)

It also defines `--e-global-color-*` and `--e-global-typography-*` as aliases of
the new tokens. Several older files (`ft-style.css`, `specs.css`,
`distributors-grid.css`, `testimonial-carousel.css`, `inc/resource-filter.php`)
and some editor content still reference those names, so the aliases keep them
working. New work should use the `--ft-*` tokens.

The remaining sheets are loaded globally and scoped by class:
`ft-layout.css` (header/footer/mobile nav), `ft-components.css` (search, cards,
carousel, front page), `ft-article.css`, `ft-archive.css`, `ft-page.css`,
`ft-product.css`.

## Editable content

The footer link columns are now WordPress menus, editable under
**Appearance → Menus**:

- Primary → "Main Nav"
- Footer — Popular links
- Footer — FT4 Powder Rheometer
- Footer — Legal information

## Not changed

ACF field groups, the five ACF post types, both ACF taxonomies, and the theme's
own shortcodes (`[resource_filter]`, `[testimonial_carousel]`,
`[distributors_grid]`, `[product_specs]`, `[synced_content]`) were never
Elementor-dependent and were left alone.

## Webfonts

Inter, Inter Tight and Roboto are loaded from Google Fonts in
`inc/helpers.php` (`freemantech_fonts`), with the same weights Elementor
requested. They matter: without them the theme names the families but falls
back to whatever the visitor has, which changes text metrics and line wrapping
on every page.

## Parity with the live site

Measured at a 1440x900 viewport against
`https://freemantech-co-uk.lhr.stackstaging.com`, comparing full document
height and the position/size of every section:

| Page | Live | Theme | Delta |
| --- | --- | --- | --- |
| Front page | 2535 | 2535 | 0 |
| About us | 2841 | 2841 | 0 |
| Applications archive | 1994 | 1994 | 0 |
| Micromeritics Products | 6036 | 6036 | 0 |
| Policy pages | 1828 | 1828 | 0 |
| Products archive | 2235 | 2237 | +2 |
| Resources archive | 3994 | 4004 | +10 |
| Accessories archive | 2020 | 2006 | −14 |
| Contact us | 2654 | 2673 | +19 |
| Support | 5471 | 5449 | −22 |
| Single article (Shear Testing) | 4683 | 4692 | +9 |
| Single article (Working with Powders) | 4706 | 4715 | +9 |
| Single resource (video, short body) | 2748 | 2759 | +11 |
| Single accessory | 2115 | 2208 | +93 |
| Single product | 6030 | 5764 | −266 |

Known causes of the remaining deltas:

- **Contact / Support / Accessory** carry JotForm iframes, whose height the
  form service sets at runtime and varies between loads.
- **Single product** mostly reflects different image assets in this database:
  `ft4-tecnolgy.jpg` is 1000x556 here and 640x356 on the live site, so the
  "How it works" tab panel renders taller. Both render the image at its natural
  size capped by its column, which is the behaviour Elementor had.
- **Single accessory** renders the featured image column at the declared 25%
  (324px) where Elementor's flex sizing settled on 249px.

## Deliberate deviations from the live site

These are places where the theme intentionally differs, rather than parity bugs:

- **Header gutter.** Elementor padded the header by 5% only below 1366px, so
  between 1367px and 1440px the logo and search sat hard against the window
  edge while the content below was inset by 72px. The header now shares
  `.main-flow`'s gutter at every width, so the logo lines up with the content's
  left edge and the search with its right.
- **Search results.** Rebuilt to read like the Resource Library listing, with a
  proper empty state, rather than reproducing the sparse default.
- **Content link colour.** Editor links on pages render in Freeman Blue. Live
  renders them `royalblue`, an underscores default that Elementor never
  overrode outside article templates.
