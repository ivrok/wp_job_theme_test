<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.09.2017
 * Time: 16:54
 */
class WpAdminInputs{
    public static $instance = null;
    private function __construct(){}
    public static function instance()
    {
        if (!self::$instance) self::$instance = new self;
        return self::$instance;
    }
    public function textInput()
    {
        return new WPAI_TextInput();
    }
    public function textarea()
    {
        return new WPAI_Textarea();
    }
    public function checkbox()
    {
        return new WPAI_Checkbox();
    }
    public function select()
    {
        return new WPAI_Select();
    }
    public function radio()
    {
        return new WPAI_Radio();
    }
}

interface WpAdminInputsInterface{
    public function get();
}
abstract class WpAdminInputsAbstract{
    protected $params = array();
    public function __construct(){}
    public function get()
    {
        return $this->params;
    }
    public function id($id)
    {
        $this->params['id'] = $id;
        return $this;
    }
    public function desc($desc)
    {
        $this->params['desc'] = $desc;
        return $this;
    }
}
class WPAI_TextInput extends WpAdminInputsAbstract implements WpAdminInputsInterface{
    public function __construct()
    {
        $this->params['type'] = 'text';
        parent::__construct();
    }
    public function label_for($id)
    {
        $this->params['label_for'] = $id;
        return $this;
    }

}
class WPAI_Textarea extends WpAdminInputsAbstract implements WpAdminInputsInterface{
    public function __construct()
    {
        $this->params['type'] = 'textarea';
        parent::__construct();
    }
}
class WPAI_Checkbox extends WpAdminInputsAbstract implements WpAdminInputsInterface{
    public function __construct()
    {
        $this->params['type'] = 'checkbox';
        parent::__construct();
    }
}
abstract class WPAI_InputWithVals extends WpAdminInputsAbstract implements WpAdminInputsInterface{
    public function val($key, $val)
    {
        if (isset($this->params['params']['vals']) && is_array($this->params['params']['vals'])) {
            $this->params['params']['vals'][$key] = $val;
        } else {
            $this->params['params']['vals'] = array($key => $val);
        }
        return $this;
    }
}
class WPAI_Radio extends WPAI_InputWithVals{
    public function __construct()
    {
        $this->params['type'] = 'radio';
        parent::__construct();
    }
}
class WPAI_Select extends WPAI_InputWithVals{
    public function __construct()
    {
        $this->params['type'] = 'select';
        parent::__construct();
    }
}