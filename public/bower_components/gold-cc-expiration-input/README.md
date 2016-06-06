
<!---

This README is automatically generated from the comments in these files:
date-input.html  date-validator.html  gold-cc-expiration-input.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

The bot does some handling of markdown. Please file a bug if it does the wrong
thing! https://github.com/PolymerLabs/tedium/issues

-->

[![Build status](https://travis-ci.org/PolymerElements/gold-cc-expiration-input.svg?branch=master)](https://travis-ci.org/PolymerElements/gold-cc-expiration-input)

_[Demo and API docs](https://elements.polymer-project.org/elements/gold-cc-expiration-input)_


##&lt;gold-cc-expiration-input&gt;

`gold-cc-expiration-input` is a  single-line text field with Material Design styling
for entering a credit card's expiration date

```html
<gold-cc-expiration-input></gold-cc-expiration-input>
<gold-cc-expiration-input value="11/15"></gold-cc-expiration-input>
```

It may include an optional label, which by default is "Expiration Date".

```html
<gold-cc-expiration-input label="Date"></gold-cc-expiration-input>
```

### Validation

The input can check whether the entered date is a valid, future date.

The input can be automatically validated as the user is typing by using
the `auto-validate` and `required` attributes. For manual validation, the
element also has a `validate()` method, which returns the validity of the
input as well sets any appropriate error messages and styles.

See `Polymer.PaperInputBehavior` for more API docs.

### Styling

See `Polymer.PaperInputContainer` for a list of custom properties used to
style this element.



<!-- No docs for <date-input> found. -->

<!-- No docs for <date-validator> found. -->
