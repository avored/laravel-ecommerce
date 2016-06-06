
<!---

This README is automatically generated from the comments in these files:
gold-cc-input.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

-->

[![Build Status](https://travis-ci.org/PolymerElements/gold-cc-input.svg?branch=master)](https://travis-ci.org/PolymerElements/gold-cc-input)

_[Demo and API Docs](https://elements.polymer-project.org/elements/gold-cc-input)_


##&lt;gold-cc-input&gt;


`gold-cc-input` is a single-line text field with Material Design styling
for entering a credit card number. As the user types, the number will be
formatted by adding a space every 4 digits.

    <gold-cc-input></gold-cc-input>

It may include an optional label, which by default is "Card number".

    <gold-cc-input label="CC"></gold-cc-input>

### Validation

The input can detect whether a credit card number is valid, and the type
of credit card it is, using the Luhn checksum. See `http://jquerycreditcardvalidator.com/`
for more information.

The input can be automatically validated as the user is typing by using
the `auto-validate` and `required` attributes. For manual validation, the
element also has a `validate()` method, which returns the validity of the
input as well sets any appropriate error messages and styles.

See `Polymer.PaperInputBehavior` for more API docs.

### Styling

See `Polymer.PaperInputContainer` for a list of custom properties used to
style this element.


