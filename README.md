# Tableau Connect for Craft CMS 3.x

Tableau integration plugin for Craft

## Requirements

This plugin requires Craft CMS 3.x and a Tableau 2.x server.

## Installation

Install ShipStation Connect from the Plugin Store or with Composer

### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for Tableau Connect.” Click on the “Install” button in its modal window.

### With Composer

Open your terminal (command line) and run the following commands:

```
# go to the project directory
cd /path/to/my-project

# tell Composer to load the plugin
composer require fostercommerce/tableauconnect

# tell Craft to install the plugin
./craft install/plugin tableauconnect
```

After installing with composer, go to the Craft control panel plugin settings page to install and configure the settings for the plugin.

## Configuration

### Tableau Server URL

This is the URL to your Tableau installation, example: https://tableau.my-org.com

### Requires Authorization

Enable this setting if you need to access views which require user authorization.

**Note:** This uses Tableau's "trusted" scheme which requires your web server's IP address to be add to the Tableau servers list of trusted addresses. See [Adding Trusted IP Addresses](https://onlinehelp.tableau.com/current/server/en-us/trusted_auth_trustIP.htm)

## Template Usage

### Render Visualization

Supports all options supported by [Tableau JS API](https://onlinehelp.tableau.com/current/api/js_api/en-us/JavaScriptAPI/js_api_ref.htm#vizcreateoptions_record)

`onFirstInteractive` and `onFirstVizSizeKnown` should be passed in as strings to Tableau Connect.

See [onFirstInteractive](https://onlinehelp.tableau.com/current/api/js_api/en-us/JavaScriptAPI/js_api_ref.htm#tableauevent_class) and [onFirstVizSizeKnown](https://onlinehelp.tableau.com/current/api/js_api/en-us/JavaScriptAPI/js_api_ref.htm#vizresizeevent_class) event classes for details about the function callback arguments.

```twig
{{craft.tableauconnect.renderVisualization('Your/View', {
  hideTabs: true,
  hideToolbar: true,
  width: '600px',
  height: '480px',
  onFirstInteractive: 'myCustomOnFirstInteractive',
  onFirstVizSizeKnown: 'myCustomOnFirstVizSizeKnown',
})}}

{% js %}
function myCustomOnFirstInteractive(e) {
  // Do something...
}

function myCustomOnFirstVizSizeKnown(e) {
  // Do something
}
{% endjs %}
```

### Embed Visualization

```twig
<iframe
  src="{{craft.tableauconnect.embedUrl('Your/View')}}"
>
</iframe>
```
