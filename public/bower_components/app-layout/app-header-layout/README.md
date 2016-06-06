##&lt;app-header-layout&gt;

app-header-layout is a wrapper element that positions an app-header and other content. This
element uses the document scroll by default, but it can also define its own scrolling region.

Using the document scroll:

```html
<app-header-layout>
  <app-header fixed condenses effects="waterfall">
    <app-toolbar>
      <div title>App name</div>
    </app-toolbar>
  </app-header>
  <div>
    main content
  </div>
</app-header-layout>
```

Using an own scrolling region:

```html
<app-header-layout has-scrolling-region style="width: 300px; height: 400px;">
  <app-header fixed condenses effects="waterfall">
    <app-toolbar>
      <div title>App name</div>
    </app-toolbar>
  </app-header>
  <div>
    main content
  </div>
</app-header-layout>
```
