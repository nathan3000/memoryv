BOOTSTRAP = ./assets/css/bootstrap.css
BOOTSTRAP_LESS = ./assets/less/bootstrap.less
BOOTSTRAP_RESPONSIVE = ./assets/css/bootstrap-responsive.css
BOOTSTRAP_RESPONSIVE_LESS = ./assets/less/responsive.less
LESS_COMPRESSOR ?= `which lessc`
WATCHR ?= `which watchr`

#
# BUILD DOCS
#

app: bootstrap
	lessc ${BOOTSTRAP_LESS} > ${BOOTSTRAP}
	lessc ${BOOTSTRAP_RESPONSIVE_LESS} > ${BOOTSTRAP_RESPONSIVE}

#
# BUILD SIMPLE BOOTSTRAP DIRECTORY
# lessc & uglifyjs are required
#

bootstrap:
	lessc ${BOOTSTRAP_LESS} > assets/css/bootstrap.css
	lessc --compress ${BOOTSTRAP_LESS} > assets/css/bootstrap.min.css
	lessc ${BOOTSTRAP_RESPONSIVE_LESS} > assets/css/bootstrap-responsive.css
	lessc --compress ${BOOTSTRAP_RESPONSIVE_LESS} > assets/css/bootstrap-responsive.min.css
	cat assets/js/bootstrap-transition.js assets/js/bootstrap-alert.js assets/js/bootstrap-button.js assets/js/bootstrap-carousel.js assets/js/bootstrap-collapse.js assets/js/bootstrap-dropdown.js assets/js/bootstrap-modal.js assets/js/bootstrap-tooltip.js assets/js/bootstrap-popover.js assets/js/bootstrap-scrollspy.js assets/js/bootstrap-tab.js assets/js/bootstrap-typeahead.js > assets/js/bootstrap.js
	uglifyjs -nc assets/js/bootstrap.js > assets/js/bootstrap.min.js

#
# WATCH LESS FILES
#

watch:
	echo "Watching less files..."; \
	watchr -e "watch('less/.*\.less') { system 'make' }"


.PHONY: dist app watch gh-pages
