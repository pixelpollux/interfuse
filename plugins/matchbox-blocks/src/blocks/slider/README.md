# Slider Block

A custom slider block built with Splide.js.

## Style Loading

This block uses a combination of WordPress block registration and direct PHP enqueuing for styles:

### Block Registration (block.json)

- `editorStyle`: "file:./index.css" - Editor-only styles
- `style`: "file:./style-index.css" - Frontend styles (built from style-index.scss)

### PHP Enqueuing (enqueue.php)

- Splide core styles (splide.min.css)
- Splide theme styles (splide-sea-green.min.css)
- Custom block styles (index.css)

The styles are loaded in this order:

1. Splide core styles
2. Splide theme styles (depends on core)
3. Custom block styles (depends on both Splide styles)

This ensures proper style loading and dependency management on both frontend and editor.

#### Splide

The Splide documentation is pretty slim on details about different layouts. Adding some examples below for reference:

1. <https://codepen.io/brandonleetran/pen/bGEKrEE>
