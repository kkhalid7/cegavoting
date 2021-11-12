<?php

namespace VotingSystem\Grids\Core;


class FormAttributes
{
    private  $attributes=[];


    public function getAttributes(): array
    {
        return $this->attributes;
    }


    public function setAttribute($key,$value)
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function setHref($value)
    {
        $this->attributes['href'] = $value;
        return $this;
    }

    public function setName($value)
    {
        $this->attributes['name'] = $value;
        return $this;
    }

    public function setDataDestination($value)
    {
        $this->attributes['data-destination'] = $value;
        return $this;
    }

    public function setSelectionMandatory()
    {
        $this->attributes['selection-mandatory'] =true;
        return $this;
    }

    public function openInNewTab($value)
    {
        $this->attributes['target'] = $value;
        return $this;
    }

    public function setAttributes($attributes)
    {
        foreach ($attributes as $key=>$value){
            $this->setAttribute($key,$value);
        }
    }

}
