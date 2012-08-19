<?php
/**
 * Created by JetBrains PhpStorm.
 * User: online
 * Date: 20.08.12
 * Time: 1:23
 * To change this template use File | Settings | File Templates.
 */

Yii::import('zii.widgets.CMenu');

class SkodaMenu extends CMenu {

    public $activateItemsOuter = true;

    //need to include this for our function to run
    public function run()
    {
        $this->renderMenu($this->items);
    }

    protected function renderMenu($items)
    {
        if(count($items))
        {
            echo CHtml::openTag('nav',$this->htmlOptions)."\n";
            $this->renderMenuRecursive($items);
            echo CHtml::closeTag('nav');
        }
    }

    protected function renderMenuRecursive($items)
    {
        $count = 0;
        $n = count($items);
        foreach ($items as $item) {
            $count++;
            $options = isset ($item['itemOptions']) ? $item['itemOptions'] : array();
            $class = array();
            if ($item['active'] && $this->activeCssClass != '') {
                if ($this->activateItemsOuter) {
                    $class [] = $this->activeCssClass;
                }
                else {
                    if (isset ($item['linkOptions'])) {
                        $item['linkOptions'] = array('class' => $item['linkOptions']['class'] . ' ' . $this->activeCssClass);

                    }
                    else {
                        $item['linkOptions'] = array('class' => $this->activeCssClass);
                    }
                }
            }
            if ($count === 1 && $this->firstItemCssClass != '')
                $class [] = $this->firstItemCssClass;
            if ($count === $n && $this->lastItemCssClass != '')
                $class [] = $this->lastItemCssClass;
            if ($class !== array()) {
                if (empty ($options['class']))
                    $options['class'] = implode(' ', $class);
                else
                    $options['class'] .= ' ' . implode(' ', $class);
            }

            if (isset ($item['url'])) {
                $label = $this->linkLabelWrapper === null ? $item['label'] : '<' . $this->linkLabelWrapper . '>' . $item['label'] . '</' . $this->linkLabelWrapper . '>';
                $menu = CHtml :: link($label, $item['url'], isset ($item['linkOptions']) ? $item['linkOptions'] : array());
            }
            else
                $menu = CHtml :: tag('span', isset ($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
            if (isset ($this->itemTemplate) || isset ($item['template'])) {
                $template = isset ($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template, array('{menu}' => $menu));
            }
            else
                echo $menu;
            if (isset ($item['items']) && count($item['items'])) {
                echo "\n" . CHtml :: openTag('nav', $this->submenuHtmlOptions) . "\n";
                $this->renderMenuRecursive($item['items']);
                echo CHtml :: closeTag('nav') . "\n";
            }
        }
    }

}