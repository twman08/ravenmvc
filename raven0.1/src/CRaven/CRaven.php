 <?php
class CRaven implements ISingleton {

private static $instance = null;

	protected function __construct() {
		$ra = &$this;
		require(RAVEN_SITE_PATH.'/config.php');
	}

	public static function Instance() {
		if(self::$instance == null) {
		self::$instance = new CRaven();
		}
		return self::$instance;
	}

	public function FrontControllerRoute() {
		// Take current url and divide it in controller, method and parameters
		$this->request = new CRequest();
		$this->request->Init();
		$controller = $this->request->controller;
		$method     = $this->request->method;
		$arguments  = $this->request->arguments;
    
		// Is the controller enabled in config.php?
		$controllerExists   = isset($this->config['controllers'][$controller]);
		$controllerEnabled   = false;
		$className          = false;
		$classExists         = false;

		if($controllerExists) {
		$controllerEnabled   = ($this->config['controllers'][$controller]['enabled'] == true);
		$className          = $this->config['controllers'][$controller]['class'];
		$classExists         = class_exists($className);
		}
    
		// Check if controller has a callable method in the controller class, if then call it
		if($controllerExists && $controllerEnabled && $classExists) {
		$rc = new ReflectionClass($className);
		if($rc->implementsInterface('IController')) {
			if($rc->hasMethod($method)) {
				$controllerObj = $rc->newInstance();
				$methodObj = $rc->getMethod($method);
				$methodObj->invokeArgs($controllerObj, $arguments);
		} else {
				die("404. " . get_class() . ' error: Controller does not contain method.');
			}
			
		} else {
				die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
			}
			
		}
			
		else { 
			die('404. Page is not found.');
		}
		
		// Take current url and divide it in controller, method and parameters
		$this->request = new CRequest();
		$this->request->Init($this->config['base_url']);
	}


// Theme Engine Render, renders the views using the selected theme.
	public function ThemeEngineRender() {
		/*echo "<h1>I'm CRaven::ThemeEngineRender</h1><p>You are most welcome. Nothing to render at the moment</p>";
		echo "<h2>The content of the config array:</h2><pre>", print_r($this->config, true) . "</pre>";
		echo "<h2>The content of the data array:</h2><pre>", print_r($this->data, true) . "</pre>";
		echo "<h2>The content of the request array:</h2><pre>", print_r($this->request, true) . "</pre>";*/
		
		 // Get the paths and settings for the theme
		$themeName    = $this->config['theme']['name'];
		$themePath    = RAVEN_INSTALL_PATH . "/themes/{$themeName}";
		$themeUrl      = $this->request->base_url . "themes/{$themeName}";
   
		// Add stylesheet path to the $ra->data array
		$this->data['stylesheet'] = "{$themeUrl}/style.css";

		// Include the global functions.php and the functions.php that are part of the theme
		$ra = &$this;
		$functionsPath = "{$themePath}/functions.php";
		if(is_file($functionsPath)) {
			include $functionsPath;
		}

		// Extract $ra->data to own variables and handover to the template file
		extract($this->data);     
		include("{$themePath}/default.tpl.php");
	}
} 