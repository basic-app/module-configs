<?php

namespace BasicApp\Config\Models;

class ConfigModel extends \BasicApp\Core\Model
{

    protected $table = 'configs';

    protected $primaryKey = 'config_id';

    protected $returnType = Config::class;

    protected $allowedFields = ['config_class', 'config_property', 'config_value'];

    public function setValue(string $class, string $property, $value)
    {
        $row = $this->where(['config_class' => $class, 'config_property' => $property])->first();

        $changed = false;

        if (!$row)
        {
            $row = new Config;

            $row->config_class = $class;
        
            $row->config_property = $property;
        
            $changed = true;
        }

        if ($row->config_value != $value)
        {
            $row->config_value = $value;
            
            $changed = true;
        }

        if ($changed)
        {
            $this->save($row);
        }
    }
}