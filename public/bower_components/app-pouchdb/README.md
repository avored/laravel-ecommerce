
<!---

This README is automatically generated from the comments in these files:
app-pouchdb-conflict-resolution.html  app-pouchdb-document.html  app-pouchdb-index.html  app-pouchdb-query.html  app-pouchdb-sync.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

The bot does some handling of markdown. Please file a bug if it does the wrong
thing! https://github.com/PolymerLabs/tedium/issues

-->


##&lt;app-pouchdb-conflict-resolution&gt;

`app-pouchdb-conflict-resolution` enables declarative configuration of conflict
resolution strategies ordered by logical relationships in the DOM. Currently
two basic strategies are supported: `firstWriteWins` and `lastWriteWins`.

To use `app-pouchdb-conflict-resolution`, simply include the element somewhere
in a document subtree at or above the ShadowRoot of an `app-pouchdb-document`
or `app-pouchdb-query`:

```html
<app-pouchdb-conflict-resolution
    strategy="lastWriteWins">
</app-pouchdb-conflict-resolution>
<app-pouchdb-document
    db-name="cats"
    doc-id="parsnip">
</app-pouchdb-document>
```

When a conflict occurs, the `app-pouchdb-document` will request fire an event
to notify of the conflict and request a resolution strategy. The
`app-pouchdb-conflict-resolution` element listens at its nearest ShadowRoot
boundary for conflict notifications, and responds to them as needed with a
configured strategy.



##&lt;app-pouchdb-document&gt;

`app-pouchdb-document` is an implementation of `Polymer.CarbonStorageBehavior`
for reading and writing to individual PouchDB documents.

In order to refer to a PouchDB document, provide the name of the database
(both local and remote databases are supported) and the ID of the document.

For example:

```html
<app-pouchdb-document
    db-name="cats"
    doc-id="parsnip">
</app-pouchdb-document>
```

In the above example, a PouchDB instance will be created to connect to the
local database named "cats". Then it will check to see if a document with the
ID "parsnip" exists. If it does, the `data` property of the document will be
set to the value of the document. If it does not, then any subsequent
assignments to the `data` property will cause a document with ID "parsnip" to
be created.

Here is an example of a simple form that can be used to read and write to a
PouchDB document:

```html
<app-pouchdb-document
    db-name="cats"
    doc-id="parsnip"
    data="{{cat}}">
</app-pouchdb-document>
<input
    is="iron-input"
    bind-value="{{cat.name}}">
</input>
```



##&lt;app-pouchdb-index&gt;

`app-pouchdb-index` enables declarative, idempotent configuration of database
indexes. The semantics map to those of the pouchdb-find plugin. For more
information on creating PouchDB indexes with pouchdb-find, please refer to the
documentation
[here](https://github.com/nolanlawson/pouchdb-find#dbcreateindexindex--callback).

Note: at least one index must be created in order for `app-pouchdb-query` to
work.



##&lt;app-pouchdb-query&gt;

`app-pouchdb-query` allows for declarative, read-only querying into a PouchDB
database. The semantics for querying match those of the
[pouchdb-find plugin](https://github.com/nolanlawson/pouchdb-find).

In order to create an `app-pouchdb-query` against any field other than `_id`, at
least one index needs to have been created in your PouchDB database. You can use
`app-pouchdb-index` to do this declaratively. For example:

```html
<app-pouchdb-index
    db-name="cats"
    fields='["name"]'>
</app-pouchdb-index>
<app-pouchdb-query
    db-name="cats"
    selector="name $exists true"
    fields='["_id","name"]'
    sort='["name"]'
    data="{{cats}}">
</app-pouchdb-query>
```

In the above example, an index is created on the "name" field of the "cats"
database. This allows the query to select by the "name" field, and sort by the
"name" field.

By default, PouchDB creates an index on the "_id" field, so if you don't
particularly care about sorting or selecting on other fields, you don't need to
create any extra indexes.

## Describing selectors

This element requires a specialized selector syntax that maps to the semantics
of the pouchdb-find plugin. For example, if you wish to create the following
selector:

```javascript
{
  series: 'Mario',
  debut: { $gt: 1990 }
}
```

You should format the `selector` property this way:

```javascript
"series $eq 'Mario', debut $gt 1990"
```

This makes selectors more convenient to write declaratively, while still
maintaining the ability to express selectors with full fidelity. For more
documentation on pouchdb-find selectors, please check out the docs
[here](https://github.com/nolanlawson/pouchdb-find#dbfindrequest--callback).



##&lt;app-pouchdb-sync&gt;

`app-pouchdb-sync` arranges for one-directional or bi-directional
synchronization between two PouchDB databases. For one-directional
synchronization, it forwards to `PouchDB.replicate`, and for bi-directional
synchronization, it forwards to `PouchDB.sync`.

Here is an example of bi-directional synchronization between a local database
and a remote one:

```html
<app-pouchdb-sync
    src="cats"
    target="https://example.com:5678/cats"
    bidirectional>
</app-pouchdb-sync>
```

For more information on PouchDB synchronization topics, please refer to the
documentation [here](https://pouchdb.com/guides/replication.html).


