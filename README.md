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
All models have to extend [Model class](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/core/Model.php). Also, they have to use `namespace models`. Lastly, create your modal class and put them in `models` folder.

### Views
The views have all html content, with as little php as possible. To use the information present in a controller, use the data sent by the controller through an array (you don't use the array directly, but instead use a variable whose name is the same as the array key name).

#### Example
- Controller

![](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/viewParameters1.png?raw=true)

- View

![](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/viewParameters2.png?raw=true)

### Controllers
Controllers have to extend [Controller class](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/core/Controller.php). Also, they have to use `namespace controllers`. All controllers must be in `controllers` folder. This class has 2 methods for showing a view and other that will be invoked depending on the url provided.

## Overview of a generic MVC PHP framework structure
![uml_diagram](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/uml/uml.png)

## How this framework works?
When a url is sent to the server, it will parse it and will identify three components:
- Controller
- Action
- Parameters

|Name| Function
|------- | ---------------------
| Controller 	|	Will invoke the identified controller or NotFoundController if it does not exist	|
| Action 		|	It is the method of the identified controller that will be called 	|
| Parameters	|	It is the parameters of the identified action	|

This parse is done in [Core class](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/core/Core.php). The main controller, that is, the one that will be called when accessing the website url, will be [HomeController](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/controllers/HomeController.php).

### Template
All views are loaded inside a [template view](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/views/template.php). You can define your website standards here, and all views will follow this standard. To do that, remember loading views with `loadTemplate` method.

### Example
![](https://github.com/williamniemiec/MVC-in-PHP/blob/master/media/example/url_parse.png)

<b>Note:</b> If an action is not sent, default action will be chosen, which is `index`. Also, if the sent controller does not exist, will be chosen [NotFoundController](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/controllers/NotFoundController.php), which will load [404 view](https://github.com/williamniemiec/MVC-in-PHP/blob/master/src/views/404.php).

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
| 	db 					| `Directory`	| Contains the database of the application
| 	models 				| `Directory`	| Contains all application model classes
| 	vendor				| `Directory`	| Folder created by Composer - responsable for classes autoload
| 	views 				| `Directory`	| Contains all application view classes
| 	.htaccess			| `File`		| Responsible for friendly url
| 	composer.json 		| `File`		| File created by Composer
| 	config.py 			| `File`		| Website configuration file (Database and website location)
| 	environment.php 	| `File`		| File responsible for defining which environment is in use
| 	index.php 			| `File`		| File responsible for starting the website

## Environment
Indicates which environment is in use. There are two:
- Development

Loads configuration for local server.

- Production

Loads configuration for online server.
