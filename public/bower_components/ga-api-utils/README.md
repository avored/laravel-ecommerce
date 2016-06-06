Google Analytics JavaScript API Utilities
=========================================

This repository is a place to find utility modules for interacting with the Google Analytics APIs. The source files are available as node-style modules (in the [/lib](https://github.com/googleanalytics/javascript-api-utils/tree/master/lib) folder) and as standalone browser scripts (in the [build](https://github.com/googleanalytics/javascript-api-utils/tree/master/build) folder). The browser versions are built with [browserify](http://browserify.org/) and can be accessed from the global object `window.gaApiUtils` or by using an AMD module loader.

## Installation

```sh
# Install via npm
npm install git+https://git@github.com/googleanalytics/javascript-api-utils.git

# Install via bower
npm install googleanalytics/javascript-api-utils
```

## Usage Examples:

**Note**: all the examples below assume the user is authenticated and `gapi.client.analytics` is loaded on the page using the [Google APIs client library](https://developers.google.com/api-client-library/javascript/start/start-js).

The easiest way to load the client library and authorize the current user is to use the [Google Analytics Embed API](https://developers.google.com/analytics/devguides/reporting/embed/).

### Account Summaries

```js
var accountSummaries = require('javascript-api-utils/lib/account-summaries');

// Log a list of all the user's Google Analytics views to the console.
accountSummaries.get().then(function(summaries) {
  console.log(summaries.allViews());
});
```

To see a demo of the account summaries module, run the [demo file](https://github.com/googleanalytics/javascript-api-utils/blob/master/build/demo.html) on a local server on port 8080.

## Contributing

If you'd like to contribute modules to this repository please follow the [Google JavaScript style guide](https://google-styleguide.googlecode.com/svn/trunk/javascriptguide.xml) and make sure to include relevant tests with any pull requests. Also include demos where appropriate.

### Running the tests

```sh
make test
```

### Building the browser versions

```sh
make build
```


