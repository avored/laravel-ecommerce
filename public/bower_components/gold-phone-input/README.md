
<!---

This README is automatically generated from the comments in these files:
gold-phone-input.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

The bot does some handling of markdown. Please file a bug if it does the wrong
thing! https://github.com/PolymerLabs/tedium/issues

-->

[![Build status](https://travis-ci.org/PolymerElements/gold-phone-input.svg?branch=master)](https://travis-ci.org/PolymerElements/gold-phone-input)

_[Demo and API docs](https://elements.polymer-project.org/elements/gold-phone-input)_


##&lt;gold-phone-input&gt;

`<gold-phone-input>` is a single-line text field with Material Design styling
for entering a phone number.

```html
<gold-phone-input></gold-phone-input>
```

It may include an optional label, which by default is "Phone number".

```html
<gold-phone-input label="call this"></gold-phone-input>
```

### Validation

By default, the phone number is considered to be a US phone number, and
will be validated according to the pattern `XXX-XXX-XXXX`, where `X` is a
digit, and `-` is the separating dash. If you want to customize the input
for a different area code or number pattern, use the `country-code` and
`phone-number-pattern` attributes

```html
<gold-phone-input
    country-code="33"
    phone-number-pattern="X-XX-XX-XX-XX">
</gold-phone-input>
```

The input can be automatically validated as the user is typing by using
the `auto-validate` and `required` attributes. For manual validation, the
element also has a `validate()` method, which returns the validity of the
input as well sets any appropriate error messages and styles.

See `Polymer.PaperInputBehavior` for more API docs.

### Styling

See `Polymer.PaperInputContainer` for a list of custom properties used to
style this element.

`--gold-phone-input-country-code` | Mixin applied to the country code span


