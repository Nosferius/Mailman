<?php

/**
 * Class controller
 *
 * This is the controller. It should have controllers per function, but we don't need those yet.
 *
 * @copyright Nosferius
 */

class controller
{
    /**
     * @var string Action we are controlling
     */
    private $action;

    /**
     * @var array used to fetch vars
     */
    private $vars;

    /**
     * @var array used to set menu actions
     */
    private $actionToViewMap;

    /**
     * construct defines actions versus what views to load and what to do when no choice was made
     */
    public function __construct()
    {
        // Define type of the variables in the class
        // not required, but very nice
        $this->action = "";
        $this->vars = [];
        $this->config = [];;

        // Which views should be displayed after which action
        // ToDO: index view folder in order to automatically add pages to the actiontoviewmap
        $this->actionToViewMap = [
            'addUser' => ['addUser'],
            'editUser' => ['editUser'],
            // XXX:Temporary for demonstration:
            'everyThing' => ['addUser', 'editUser']
        ];

        // Actions default to themselves unless otherwise specified.
        // fixme: not implemented
        $this->nextActionMap = [
            'something' => 'somethingElse'
        ];
    }

    /**
     * This function loads the selected view through eval and concatenates a ?> to every view,
     * this is required to run the code without errors
     */
    private function loadView($view)
    {
        $code = file_get_contents("lib/view/" . $view . ".phtml");
        return eval ("?>" . $code);
    }

    /**
     * Loads variables to be used later
     */
    private function loadVars()
    {
        $users = new addressBook();
        $this->vars["composers"] = $users->fetch();
    }

    /**
     * run brings all views and vars together
     */
    public function run()
    {
        $this->loadVars();

        // Perform controller action if exists

        // fixme: This is a security problem, methods can be executed from the url
        // fixme: build hashmap
        // fixme: actually, do it like the views with a actionControllerActionMap
        if(method_exists($this,$this->action)){
            $this->{$this->action}();
        };

        // Always use last action as action

        $this->vars['action'] = $this->action;

        // Unless overridden by fixme: not implemented

        // Always include header and navigation
        $html = $this->loadView("header");
        $html .= $this->loadView("navigation");

        if ($this->action != "") {
            // Include all views required for this action as defined in the actionToViewMap
            foreach($this->actionToViewMap[$this->action] as $action){
                $html .= $this->loadView($action);
            }
        }
        // Set default opening page in elseif if no action is given
        elseif ($this->action =! "") {
            $html .= $this->loadView("placeholder");
            $html .= $this->loadView("addUser");
        }

        // Always include footer
        $html .= $this->loadView("footer");

        return $html;
    }

    /**
     * makes sure variables for users are fetched properly
     */
    public function showUsers()
    {
        $users = new addressBook();
        $this->vars['users'] = $users->fetch();
    }

    // fixme: finalize this function
    public function showComposers()
        //forlateruse
    {
    }

    /**
     * makes sure variables for user editing are fetched properly
     */
    public function editUser() {
        $users = new addressBook();
        $this->vars['users'] = $users->fetch();

        $user = new addressBook();
        if (array_key_exists('id',$_GET)) {
            $this->vars['user'] = $user->fetchByID($_GET['id']);
        }
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * @param mixed $vars
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return array
     */
    public function getActionToViewMap()
    {
        return $this->actionToViewMap;
    }

    /**
     * @param array $actionToViewMap
     */
    public function setActionToViewMap($actionToViewMap)
    {
        $this->actionToViewMap = $actionToViewMap;
    }

}

?>