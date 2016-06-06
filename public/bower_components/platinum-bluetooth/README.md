
<!---

This README is automatically generated from the comments in these files:
platinum-bluetooth-characteristic.html  platinum-bluetooth-device.html  platinum-bluetooth-service.html

Edit those files, and our readme bot will duplicate them over here!
Edit this file, and the bot will squash your changes :)

The bot does some handling of markdown. Please file a bug if it does the wrong
thing! https://github.com/PolymerLabs/tedium/issues

-->

[![Build status](https://travis-ci.org/PolymerElements/platinum-bluetooth.svg?branch=master)](https://travis-ci.org/PolymerElements/platinum-bluetooth)

_[Demo and API docs](https://elements.polymer-project.org/elements/platinum-bluetooth)_


##&lt;platinum-bluetooth-characteristic&gt;

The `<platinum-bluetooth-characteristic>` element allows you to [read
and write characteristics on nearby bluetooth devices](https://developers.google.com/web/updates/2015/07/interact-with-ble-devices-on-the-web) thanks to the
young [Web Bluetooth API](https://github.com/WebBluetoothCG/web-bluetooth). It is currently only partially implemented
in Chrome OS 45 and Chrome 49 for Android behind the experimental flag
`chrome://flags/#enable-web-bluetooth`.

`<platinum-bluetooth-characteristic>` needs to be a child of a
`<platinum-bluetooth-service>` element.

For instance, here's how to read battery level from a nearby bluetooth
device advertising Battery service:

```html
<platinum-bluetooth-device services-filter='["battery_service"]'>
  <platinum-bluetooth-service service='battery_service'>
    <platinum-bluetooth-characteristic characteristic='battery_level'>
    </platinum-bluetooth-characteristic>
  </platinum-bluetooth-service>
</platinum-bluetooth-device>
```

```js
var bluetoothDevice = document.querySelector('platinum-bluetooth-device');
var batteryLevel = document.querySelector('platinum-bluetooth-characteristic');

button.addEventListener('click', function() {
  bluetoothDevice.request().then(function() {
    return batteryLevel.read().then(function(value) {
      console.log('Battery Level is ' + value.getUint8(0) + '%');
    });
  })
  .catch(function(error) { });
});
```

Here's another example on how to reset energy expended on nearby
bluetooth device advertising Heart Rate service:

```html
<platinum-bluetooth-device services-filter='["heart_rate"]'>
  <platinum-bluetooth-service service='heart_rate'>
    <platinum-bluetooth-characteristic characteristic='heart_rate_control_point'>
    </platinum-bluetooth-characteristic>
  </platinum-bluetooth-service>
</platinum-bluetooth-device>
```

```js
var bluetoothDevice = document.querySelector('platinum-bluetooth-device');
var heartRateCtrlPoint = document.querySelector('platinum-bluetooth-characteristic');

button.addEventListener('click', function() {
  bluetoothDevice.request().then(function() {
    // Writing 1 is the signal to reset energy expended.
    var resetEnergyExpended = new Uint8Array([1]);
    return heartRateCtrlPoint.write(resetEnergyExpended).then(function() {
      console.log('Energy expended has been reset');
    });
  })
  .catch(function(error) { });
});
```

It is also possible for `<platinum-bluetooth-characteristic>` to fill in
a data-bound field in response to a read.

```html
<platinum-bluetooth-device services-filter='["heart_rate"]'>
  <platinum-bluetooth-service service='heart_rate'>
    <platinum-bluetooth-characteristic characteristic='body_sensor_location'
                                       value={{bodySensorLocation}}>
    </platinum-bluetooth-characteristic>
  </platinum-bluetooth-service>
</platinum-bluetooth-device>
...
<span>{{bodySensorLocation}}</span>
```

```js
var bluetoothDevice = document.querySelector('platinum-bluetooth-device');
var bodySensorLocation = document.querySelector('platinum-bluetooth-characteristic');

button.addEventListener('click', function() {
  bluetoothDevice.request().then(function() {
    return bodySensorLocation.read()
  })
  .catch(function(error) { });
});
```

Starting and stopping notifications on a `<platinum-bluetooth-characteristic>` is pretty straightforward when taking advantage of the [Polymer Change notification protocol](https://www.polymer-project.org/1.0/docs/devguide/data-binding.html#change-notification-protocol). Here's how to get your Heart Rate Measurement for instance:

```html
<platinum-bluetooth-device services-filter='["heart_rate"]'>
  <platinum-bluetooth-service service='heart_rate'>
    <platinum-bluetooth-characteristic characteristic='heart_rate_measurement'
                                       on-value-changed='parseHeartRate'>
    </platinum-bluetooth-characteristic>
  </platinum-bluetooth-service>
</platinum-bluetooth-device>
```

```js
var bluetoothDevice = document.querySelector('platinum-bluetooth-device');
var heartRate = document.querySelector('platinum-bluetooth-characteristic');

startButton.addEventListener('click', function() {
  bluetoothDevice.request().then(function() {
    return heartRate.startNotifications().catch(function(error) { });
  });
});

stopButton.addEventListener('click', function() {
  heartRate.stopNotifications().catch(function(error) { });
});

function parseHeartRate(event) {
 let value = event.target.value;
 // Do something with the DataView Object value...
}
```

You can also use changes in `value` to drive characteristic writes when
`auto-write` property is set to true.

```html
<platinum-bluetooth-device services-filter='["heart_rate"]'>
  <platinum-bluetooth-service service='heart_rate'>
    <platinum-bluetooth-characteristic characteristic='heart_rate_control_point'
                                              auto-write>
    </platinum-bluetooth-characteristic>
  </platinum-bluetooth-service>
</platinum-bluetooth-device>
```

```js
var bluetoothDevice = document.querySelector('platinum-bluetooth-device');
var heartRateCtrlPoint = document.querySelector('platinum-bluetooth-characteristic');

button.addEventListener('click', function() {
  bluetoothDevice.request().then(function() {
    // Writing 1 is the signal to reset energy expended.
    heartRateCtrlPoint.value = new Uint8Array([1]);
  })
  .catch(function(error) { });
});

heartRateCtrlPoint.addEventListener('platinum-bluetooth-auto-write-error',
    function(event) {
  // Handle error...
});
```



##&lt;platinum-bluetooth-device&gt;

The `<platinum-bluetooth-device>` element allows you to [discover nearby
bluetooth devices](https://developers.google.com/web/updates/2015/07/interact-with-ble-devices-on-the-web) thanks to the young [Web Bluetooth API](https://github.com/WebBluetoothCG/web-bluetooth). It is
currently only partially implemented in Chrome OS 45 and Chrome 49 for
Android behind the experimental flag
`chrome://flags/#enable-web-bluetooth`.

`<platinum-bluetooth-device>` is used as a parent element for
`<platinum-bluetooth-service>` child elements.

For instance, here's how to request a nearby bluetooth device advertising
Battery service:

```html
<platinum-bluetooth-device services-filter='["battery_service"]'>
</platinum-bluetooth-device>
```

```js
button.addEventListener('click', function() {
  document.querySelector('platinum-bluetooth-device').request()
  .then(function(device) { console.log(device.name); })
  .catch(function(error) { console.error(error); });
});
```

You can also request a nearby bluetooth device by setting a filter on
a name or name Prefix:

```html
<platinum-bluetooth-device name-filter='foobar'>
</platinum-bluetooth-device>
```

```html
<platinum-bluetooth-device name-prefix-filter='foo'>
</platinum-bluetooth-device>
```

And you can combine some of the filters as well. Here's how to request a
nearby bluetooth device advertising Battery service and whose name is
"foobar":

```html
<platinum-bluetooth-device services-filter='["battery_service"]'
                           name-filter='foobar'>
</platinum-bluetooth-device>
```

If you filter just by name, then you must use `optional-services-filter`
to get access to any services:

```html
<platinum-bluetooth-device name-filter='foobar'
                           optional-services-filter='["battery_service"]'>
</platinum-bluetooth-device>
```

Disconnecting manually from a connected bluetooth device is pretty
straightforward:

```js
disconnectButton.addEventListener('click', function() {
  document.querySelector('platinum-bluetooth-device').disconnect();
});
```



##&lt;platinum-bluetooth-service&gt;

The `<platinum-bluetooth-service>` element is used in conjuction with
the `<platinum-bluetooth-characteristic>` element to [read and write
characteristics on nearby bluetooth devices](https://developers.google.com/web/updates/2015/07/interact-with-ble-devices-on-the-web) thanks to the young [Web
Bluetooth API](https://github.com/WebBluetoothCG/web-bluetooth). It is currently only partially implemented
in Chrome OS 45 and Chrome 49 for Android behind the experimental flag
`chrome://flags/#enable-web-bluetooth`.

`<platinum-bluetooth-service>` needs to be a child of a
`<platinum-bluetooth-device>` element.

For instance, here's how to read battery level from a nearby bluetooth
device advertising Battery service:

```html
<platinum-bluetooth-device services-filter='["battery_service"]'>
  <platinum-bluetooth-service service='battery_service'>
    <platinum-bluetooth-characteristic characteristic='battery_level'>
    </platinum-bluetooth-characteristic>
  </platinum-bluetooth-service>
</platinum-bluetooth-device>
```

```js
var bluetoothDevice = document.querySelector('platinum-bluetooth-device');
var batteryLevel = document.querySelector('platinum-bluetooth-characteristic');

button.addEventListener('click', function() {
  bluetoothDevice.request().then(function() {
    return batteryLevel.read().then(function(value) {
      console.log('Battery Level is ' + value.getUint8(0) + '%');
    });
  })
  .catch(function(error) { });
});
```


