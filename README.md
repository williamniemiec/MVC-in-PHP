# MVC in PHP
![](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/logo/logo.jpg)

This project aims to provide an MVC PHP framework for you to use in your projects. If you want to see an example there is a complete example [here](https://github.com/williamniemiec/wp_eCommerce) about an e-commerce website.

<hr />

## What is MVC?
Briefly, MVC (Model View Controller) is a design pattern widely used in projects because it leaves the project structured in order to facilitate the identification of application modules, understand how it is structured, in addition to facilitating maintenance. It structures the project in three modules:

|Name| Funcion
|------- | -------------- 
|Models | Responsible for business logic
|View | Responsible for the visual part
|Controllers | Responsible for the behavior of the visual part

### Nomenclature
This project adopted the following naming pattern:
|Type| Name
|------- | --- 
| Controller | <i>&lt;ControllerName&gt;</i>Controller
| View | <i>&lt;viewName&gt;</i>


## How to use this structure in my project?
In `src` folder is all what you need to apply this pattern in your project. 

## How to create new models, views and controllers?
This framework uses autoload for loading classes. Consequently, you have to use namespace's and use's in classes.

### Models
All models have to extend [Model class](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/core/Model.php). Also, they must use `namespace models`. Lastly, when you create your modal classes, put them in `models` folder.

### Views
The views have all html content, with as little php as possible. To use the information present in a controller, use the data sent by the controller through an array (you don't use the array directly, but instead use a variable whose name is the same as the array key name).

#### Example
- Controller

![viewParameters_controller](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/viewParameters1.png?raw=true)

- View

![viewParameters_view](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/viewParameters2.png?raw=true)

### Controllers
Controllers have to extend [Controller class](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/core/Controller.php). Also, they must use `namespace controllers`. All controllers must be in `controllers` folder. This class has 2 methods for showing a view and another that will be invoked depending on the url provided.
Also, if you call a view using `loadTemplate` function, you must send the following attributes to the view:
- title
- description
- keywords (useful for SEO)
- robots ('index' if the page should be indexed by SEO; 'noindex' otherwise)

#### Example - Home controller
![controller_args](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/controller_args.png?raw=true)


## How this framework works?
When a url is sent to the server, it will parse it to identify three components:
- Controller
- Action
- Parameters

|Name| Function
|------- | ---------------------
| Controller 	|	Will invoke the identified controller	|
| Action 		|	It is the method of the identified controller that will be called 	|
| Parameters	|	It is the parameters of the identified action	|

This parse is done in [Core class](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/core/Core.php). The main controller, that is, the one that will be called when accessing the website url, will be [HomeController](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/controllers/HomeController.php).

<b>Note:</b> If the sent controller does not exist, will be chosen [NotFoundController](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/controllers/NotFoundController.php), which will load [404 view](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/views/404.php).

### Example
![](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/url_parse.png)

### Default values
When some of these components are not sent they will have the following default values:

|Name| Function
|------- | ---------------------
| Controller 	|	[HomeController](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/controllers/HomeController.php) |
| Action 	|	[index](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/index.php) |
| Parameters 	|	Empty array |

### Template
All views are loaded inside a [template view](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/views/template.php). You can define your website standards here, and all views will follow this standard. To do that, remember loading views with `loadTemplate` method.

## Overview of a generic MVC PHP framework structure
![uml_diagram](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/uml/uml.png)

## Project organization
The MVC structure is in `src` folder.

### /
|Name| Type| Function
|------- | --- | ----
| media	|	 `Directory`	| Visual information of the project
| src 	|	 `Directory`	| MVC framework


### /src
|Name| Type| Function
|------- | --- | ----
| 	assets				| `Directory`	| Contains all application content files
| 	controllers 		| `Directory`	| Contains all application controller classes
| 	core 				| `Directory`	| Contains the classes responsable for the MVC operations
| 	models 				| `Directory`	| Contains all application model classes
| 	vendor				| `Directory`	| Folder created by [Composer](https://getcomposer.org/) - responsable for classes autoload
| 	views 				| `Directory`	| Contains all application view classes
| 	.htaccess			| `File`		| Responsible for friendly url
| 	composer.json 		| `File`		| File created by Composer
| 	config.py 			| `File`		| Website configuration file (Database and website location)
| 	environment.php 	| `File`		| File responsible for defining which environment is in use
| 	index.php 			| `File`		| File responsible for starting the website
| 	robots.txt 			| `File`		| Determines which files [crawlers](https://en.wikipedia.org/wiki/Web_crawler) can see

## Environment
Indicates which environment is in use. There are two:
- Development

Loads configuration for local server.

- Production

Loads configuration for online server.
