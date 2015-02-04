<?php
namespace luya\collection;

class Links extends \luya\base\Collection implements \luya\collection\LinksInterface
{
    private $links = [];

    public function getAll()
    {
        return $this->links;
    }

    public function getByArguments(array $argsArray)
    {
        $_index = $this->getAll();

        foreach ($argsArray as $key => $value) {
            foreach ($_index as $link => $args) {
                if (!isset($args[$key])) {
                    unset($_index[$link]);
                }

                if (isset($args[$key]) && $args[$key] !== $value) {
                    unset($_index[$link]);
                }
            }
        }

        return $_index;
    }
    
    public function getOneByArguments(array $argsArray)
    {
        $links = $this->getByArguments($argsArray);
        if (empty($links)) {
            return false;
        }
        return array_values($links)[0];
    }
    
    public function teardown($link)
    {
        $parent = $this->getParent($link);
        
        $tears[] = $this->getLink($link);
        while ($parent) {
            $tears[] = $parent;
            $link = $parent['url'];
            $parent = $this->getParent($link);
        }
        
        $tears = array_reverse($tears);
        
        return $tears;
    }
    
    public function getParents($link)
    {
        $parent = $this->getParent($link);
        
        $tears = [];
        while ($parent) {
            $tears[] = $parent;
            $link = $parent['url'];
            $parent = $this->getParent($link);
        }
        
        $tears = array_reverse($tears);
        
        return $tears;
    }
    
    public function getParent($link)
    {
        $link = $this->getLink($link);
        
        return $this->getOneByArguments(['id' => $link['parent_nav_id']]);
    }
    
    public function getChilds($link)
    {
        $child = $this->getChild($link);
        $tears = [];
        while ($child) {
            $tears[] = $child;
            $link = $child['url'];
            $child = $this->getChild($link);
        }
        
        return $tears;
    }
    
    public function getChild($link)
    {
        $link = $this->getLink($link);
        
        return $this->getOneByArguments(['parent_nav_id' => $link['id']]);
    }
    
    public function addLink($link, $args)
    {
        $this->links[$link] = $args;
    }

    public function getLink($link)
    {
        return $this->links[$link];
    }

    private $activeLink;

    public function setActiveLink($activeLink)
    {
        $this->activeLink = $activeLink;
    }

    public function getActiveLink()
    {
        return $this->activeLink;
    }
}
