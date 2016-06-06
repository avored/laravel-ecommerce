bin_path := ./node_modules/.bin

all: build

install:
	@ npm install

lint:
	@ $(bin_path)/jshint --show-non-errors lib test

test:
	@ $(bin_path)/mocha --reporter spec --recursive test

test_debug:
	@ $(bin_path)/mocha --debug-brk --reporter spec --recursive test

build: install lint test
	@ $(bin_path)/browserify lib \
		-s gaApiUtils \
		| $(bin_path)/uglifyjs -o build/ga-api-utils.js

.PHONY: all install lint test test_debug build
