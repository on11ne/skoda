<?php

class AdminModule extends CWebModule
{
    private $_assetsUrl;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));

        // apply themes to admin's module
        Yii::app()->theme = 'blue';
        // set default layout
        $this->layout = 'main';
	}

    /**
     * @return string the base URL that contains all published asset files of admin.
     */
    public function getAssetsUrl() {

        if($this->_assetsUrl===null)
            $this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
        return $this->_assetsUrl;
    }

    public function setAssetsUrl($value) {

        return $this->_assetsUrl = $value;
    }

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
