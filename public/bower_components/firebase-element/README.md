firebase-element
================

See the [component page](https://elements.polymer-project.org/elements/firebase-element?active=firebase-collection) for more information.

firebase.html
=============

Import files are a new invention, so libraries like [`firebase`](http://firebase.com) do not yet provide them.

`firebase.html` is an intermediary that provides an import file for the `firebase` component. `firebase.html` depends on `firebase`.

Components that want to use `firebase` should depend on `firebase-element` and import `firebase.html` to be safe from library duplication.
Such components need not use Polymer or `firebase-element`, but we put the import and the element in one package for convenience.
