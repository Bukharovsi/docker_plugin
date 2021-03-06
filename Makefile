### Variables

# Applications
COMPOSER ?= /usr/bin/env composer

### Helpers
all: clean depend

.PHONY: all

### Dependencies
depend:
	${COMPOSER} install --no-progress --prefer-source

.PHONY: depend

### QA
qa: lint phpcs phpmd

lint:
	find ./src -name "*.php" -exec /usr/bin/env php -l {} \; | grep "Parse error" > /dev/null && exit 1 || exit 0
	find ./test -name "*.php" -exec /usr/bin/env php -l {} \; | grep "Parse error" > /dev/null && exit 1 || exit 0

phploc:
	vendor/bin/phploc src

phpmd:
	vendor/bin/phpmd --suffixes php src/ text codesize,design,naming,unusedcode,controversial

phpcs:
	vendor/bin/phpcs --standard=PSR2 --extensions=php src/ test/

phpcbf:
	vendor/bin/phpcbf --standard=PSR2 --extensions=php src/ test/

.PHONY: qa lint phploc phpmd phpcs phpcpd

### Testing
test:
	vendor/bin/phpunit -v --colors

.PHONY: test

### Cleaning
clean:
	rm -rf vendor

.PHONY: clean
