
<!---

This README is automatically generated from the comments in these files:
gold-zip-input.html  zip-validator.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

The bot does some handling of markdown. Please file a bug if it does the wrong
thing! https://github.com/PolymerLabs/tedium/issues

-->

[![Build Status](https://travis-ci.org/PolymerElements/gold-zip-input.svg?branch=master)](https://travis-ci.org/PolymerElements/gold-zip-input)

_[Demo and API Docs](https://elements.polymer-project.org/elements/gold-zip-input)_


##&lt;gold-zip-input&gt;

`gold-zip-input` is a single-line text field with Material Design styling
for entering a US zip code.

```html
<gold-zip-input></gold-zip-input>
```

It may include an optional label, which by default is "Zip Code".

```html
<gold-zip-input label="Mailing zip code"></gold-zip-input>
```

### Validation

The input supports both 5 digit zip codes (90210) or the full 9 digit ones,
separated by a dash (90210-9999).

The input can be automatically validated as the user is typing by using
the `auto-validate` and `required` attributes. For manual validation, the
element also has a `validate()` method, which returns the validity of the
input as well sets any appropriate error messages and styles.

See `Polymer.PaperInputBehavior` for more API docs.

### Styling

See `Polymer.PaperInputContainer` for a list of custom properties used to
style this element.



<!-- No docs for <zip-validator> found. -->
