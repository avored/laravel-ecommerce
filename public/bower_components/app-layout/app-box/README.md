##&lt;app-box&gt;

app-box is a container element that can have scroll effects - visual effects based on
scroll position. For example, the parallax effect can be used to move an image at a slower
rate than the foreground.

```html
<app-box style="height: 100px;" effects="parallax-background">
  <img background src="picture.png" style="width: 100%; height: 600px;">
</app-box>
```

Notice the `background` attribute in the `img` element; this attribute specifies that that image is used as the background.
By adding the background to the light dom, you can compose backgrounds that can change dynamically.
Alternatively, the mixin `--app-box-background-front-layer` allows to style the background. For example:

```css
  .parallaxAppBox {
    --app-box-background-front-layer: {
      background-image: url(picture.png);
    };
  }
```

Finally, app-box can have content inside. For example:

```html
<app-box effects="parallax-background">
  <h2>Sub title</h2>
</app-box>
```

## Scroll effects

Effect name | Description
----------------|-------------
`parallax-background` | A parallax effect

## Styling

Mixin | Description | Default
----------------|-------------|----------
`--app-box-background-front-layer` | Applies to the front layer of the background | {}