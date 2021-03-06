# NgRest ActiveWindow

An *NgRest ActiveWindow* is a concept to attach a modal window into an [Ng Rest Crud List](app-admin-module-ngrest.md). The Active Window is always bound to an **ID** of an item and is represented as a button with an icon and/or an alias. An example of a Button in the crud list:

![button](https://raw.githubusercontent.com/luyadev/luya/master/docs/guide1.0/img/aw_button.png "Active Window Button")

An example of an active window (Change Password) when clicked:

![overlay-window](https://raw.githubusercontent.com/luyadev/luya/master/docs/guide1.0/img/aw_window.png "Active Window Overlay")

### Create an Active Window

> Use the [aw/create console command](luya-console.md) to generate a new Active Window.

A very example basic class with the name *TestActiveWindow* just renders an index and contains a callback:

```php
namespace mymodule\aws;

class TestActiveWindow extends \luya\admin\ngrest\base\ActiveWindow
{
    public $module = 'mymodule';
    
    public function index()
    {
        return $this->render("index");
    }
    
    public function callbackSayHello($name)
    {
        $this->sendSuccess('Hello: ' . $this->itemId);
    }
}
```

Some general informations about Active Windows:

+ The popertie `$module` is required and is used to determine the path for the views files.
+ The `index()` method is required and will always be the default method which is rendered when clicking on the button in the crud grid list.
+ Callbacks must be prefix with `callback`, the properties of the callbacks can be either required or not.

Wokring with callbacks

+ To return successfull data use `sendSuccess($message)`.
+ To return error data use `sendError($message)`.

## Attaching the Class

In order to add an Active Window into your NgRest config, you have to add the class to the `aw` pointer of your config and use the `load` method to bind the class to the aw pointer. As the Active Window contains the yii\base\Object as extend class you can configure all public properties while loading the class. Below an example of how to load an Active Window class and defined `alias` and `icon` public properties. The alias and icon probierts does exist in every Active Window an can always be overwritten.

```php
public function ngRestConfig($config)
{
    $config->aw->load(['class' => \luya\admin\aws\TestActiveWindow::className(), 'alias' => 'My Window Alias', 'icon' => 'extension']);
    
    // ...
    
    return $config;
}
```

### View Files

To render view files you can run the method `$this->render()` inside your active window class. The render method will lookup for php view file based on the base path of your `$module` propertie. Lets assume we run `$this->render('index')` and have defined `admin` as your `$module` propertie and your Active Window name is `TestActiveWindow` this will try to find the view file under the path `@admin/views/aws/test/index.php`. 

### How to make Button

In order to create a button with a callback we use the helper method `$this->callbackButton`. Example view File

```php
<?php
/*
 * @var $this \luya\admin\ngrest\base\ActiveWindowView
 */

echo $this->callbackButton('My Button', 'hello-world', ['params' => ['name' => 'John Doe']]);
```

The callback of this button should look like this:

```php
public function callbackHelloWolrd($name)
{
    return $this->sendSuccess('Hello ' . $name);
}
```

### Generate a Form

You can also use the callback from widget to create a form sending data to a callback

```php
<? $form = CallbackFormWidget::begin(['callback' => 'post-data', 'buttonValue' => 'Submit']); ?>
<?= $form->field('firstname', 'Firstname'); ?>
<?= $form->field('lastname', 'Lastname:'); ?>
<?= $form->field('message')->textarea(); ?>
<? $form::end(); ?>
```

The corresponding callback should look like this:

```php
public function callbackPostData($firstname, $lastname)
{
    return $this->sendError('error while collecting data... maybe?');
}
```

### Angular in View files

As the administration interface is written in angular you can aso create inline Angular Controllers and interact with your Active Window class.

The below view file shows an Angular Controller which collectis data from the the controller assigned into the view, but uses ng-repeat to display and render the data.

```
<script>
zaa.bootstrap.register('InlineController', function($scope, $controller) {

	$scope.data = <?= $dataFromController; ?>;

	$scope.addToList = function(member) {
		$scope.$parent.sendActiveWindowCallback('add-to-list', {member:member}).then(function(response) {
			$scope.$parent.activeWindowReload();
		});
	};
});
</script>
<div class="row" ng-controller="InlineController">
	<ul>
		<li ng-click="addToList(member)" ng-repeat="item in data">{{item.name}}</li>
	</ul>
</div>
```

After the the Active Window response from function `addToList` has recieved, the active window well be reloaded. This is just a very quick integration example and does not give the user a true angular experience, but let you create solutions in a very quick time.

## Existing Reusable Active Windows

The admin module of LUYA provides some basic reusable active windows you can reuse and work with them out of the box, just attach them to your ngrest config and maybe change some properties.

|Name   |Class |Public Properties
|--     |--     |--
|Tag    |`luya\admin\aws\TagActiveWindow`|<ul><li>$tableName</li></ul>
|Gallery|`luya\admin\aws\Gallery`|<ul><li>$refTableName</li><li>$imageIdFieldName</li><li>$refFieldName</li></ul>
|ChangePassword|`luya\admin\aws\ChangePassword`|<ul><li>$className</li></ul>
|CoordinatesActiveWindow|`luya\admin\aws\CoordinatesActiveWindow`|<ul><li>$ampsApikey</li></ul>
|FlowActiveWindow|`luya\admin\aws\FlowActiveWindow`|<ul><li>$modelClass</li></ul>
