
<!---

This README is automatically generated from the comments in these files:
app-indexeddb-mirror.html  app-localstorage-document.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

The bot does some handling of markdown. Please file a bug if it does the wrong
thing! https://github.com/PolymerLabs/tedium/issues

-->


##&lt;app-indexeddb-mirror&gt;

`app-indexeddb-mirror` is a purpose-built element to easily add read-only
offline access of application data that is typically only available when the
user is connected to the network.

When an app using this element is connected to the network, the element acts as
a pass-through for live application data. Data is bound into the `data`
property, and consumers of the data can bind to the correlated `persistedData`
property. As live data changes, `app-indexeddb-mirror` caches a copy of the live
data in a local IndexedDB database. When the app is no longer connected to the
network, `app-indexeddb-mirror` toggles its `persistedData` property to refer
to a read-only copy of the corresponding data in IndexedDB.

This element is particularly useful in cases where an API or storage layer (such
as Firebase, for example) does not support caching data for later use during
user sessions that begin while the user is disconnected from the network.

Here is an example of using `app-indexeddb-mirror` with `iron-ajax`:

```html
<iron-ajax
    url="/api/cats"
    handle-as="json"
    last-response="{{liveData}}">
</iron-ajax>
<app-indexeddb-mirror
    key="cats"
    data="{{liveData}}"
    persisted-data="{{persistedData}}">
</app-indexeddb-mirror>

<template is="dom-repeat" items="{{persistedData}}" as="cat">
  <div>[[cat.name]]</div>
</template>
```

In the example above, `persistedData` will always be populated with
the most recently requested list of cats, even when the user is offline, and
even if the user refreshes the app, as long as the request as been made at
least once while connected to the network.

Of course, in the case of `iron-ajax`, it's totally possible to selectively
cache network requests in a ServiceWorker for the same effect. However, this is
not the true for all data sources. For example, if a data source is provided
over a WebSocket, it will not be cacheable by a ServiceWorker. Cases like this
are where `app-indexeddb-mirror` really shines:

```html
<firebase-query
    app-name="cats-app"
    path="/cats"
    order-by-child="name"
    data="{{liveData}}">
</firebase-query>
<app-indexeddb-mirror
    key="cats"
    data="{{liveData}}"
    persisted-data="{{persistedData}}">
</app-indexeddb-mirror>

<template is="dom-repeat" items="{{persistedData}}" as="cat">
  <div>[[cat.name]]</div>
</template>
```

Firebase data is typically provided over a WebSocket connection, so it is very
tricky to cache it for offline access. With `app-indexeddb-mirror`, offline
access to Firebase data is trivially easy to implement.

## User sessions

`app-indexeddb-mirror` caches data in a local IndexedDB database. If your app
features user authentication, it is usually desireable to ensure that this data
does not leak across the sessions of different users on the same device.

In support of this, each `app-indexeddb-mirror` is configured with a unique
session key. When the session key changes, it will automatically wipe the local
IndexedDB copy of any data that has been persisted.

```html
<app-indexeddb-mirror
    session="a-unique-session-key-413"
    key="cats"
    data="{{liveData}}"
    persisted-data="{{persistedData}}">
</app-indexeddb-mirror>
```

When `someUniqueSessionKey` changes to a different value, `app-indexeddb-mirror`
will delete the local data it is persisting at the `"cats"` key.

## Important considerations regarding WebWorkers

In order to ensure that operations on IndexedDB block the main browser thread as
little as possible, `app-indexeddb-mirror` relies on a WebWorker to operate on
its corresponding IndexedDB database. If you are vulcanizing or otherwise
combining your source files before your app is deployed, make sure that you
include the corresponding worker script (`app-indexeddb-mirror-worker.js`)
among your deployable files. You can configure the path to the worker script
with the `worker-url` attribute.

`app-indexeddb-mirror` will prefer SharedWorker if it is available in the
browser where the app is running. If SharedWorker is not available, it will
attempt to fall back to a standard WebWorker. When using a standard WebWorker,
all `app-indexeddb-mirror` instances with the same `workerUrl` will share the
same WebWorker instance.

If WebWorkers are not supported in the browser, persisted offline data will not
be available through this element.



##&lt;app-localstorage-document&gt;

app-localstorage-document synchronizes storage between an in-memory
value and a location in the browser's localStorage system.

localStorage is a simple and widely supported storage API that provides both
permanent and session-based storage options. Using app-localstorage-document
you can easily integrate localStorage into your app via normal Polymer
databinding.

app-localstorage-document is the reference implementation of an element
that uses `AppStorageBehavior`. Reading its code is a good way to get
started writing your own storage element.

Example use:

```html
<paper-input value="{{search}}"></paper-input>
<app-localstorage-document key="search" data="{{search}}">
</app-localstorage-document>
```

app-localstorage-document automatically synchronizes changes to the
same key across multiple tabs.

Only supports storing JSON-serializable values.


