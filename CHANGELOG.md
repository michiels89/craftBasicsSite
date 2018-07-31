# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).


## [1.0] - 2017-09-18

### Changed
- flyout.scss: Full refactor new animations, new styling
- hero.scss: Refactor template, new naming hero--light instead of text--white
- nav.scss: Refactor nav--main added flyout breakpoint for mobile
- helpers.scss: Uncommented .pull--bp-#{$bp}--right by default
- snippet/nav/main.twig: Refactor {{ node.listClass }} added so you can add a class form the backend
- snippet/nav/doormat.twig: Refactor {{ node.listClass }} added so you can add a class form the backend
- snippet/nav/flyout.twig: Refactor {{ node.listClass }} added so you can add a class form the backend
- snippet/nav/service.twig: Refactor {{ node.listClass }} added so you can add a class form the backend
- snippet/content/block/form.twig: Refactor added an if around {{ block.form.render() }} if not selected in the backend then dont print it + added a lightswitch for offset of the form
- snippet/content/block/textOneColumn.twig: Refactor also added a lightswitch for offset of this block
- snippet/global/footer.twig: Added an if around social media nav + title

### Added
- grid.scss: Added .grid--bp-#{$bp}__offset by default
- nav.scss: Added nav--doormat and nav--footer
- snippet/global/search.twig: Added search snippet that is included inside the snippet/nav/main.twig
- freeform/takeoff.twig: Added takeoff template for styling of the form + validation
