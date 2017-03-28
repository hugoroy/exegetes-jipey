<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:18
 */

namespace AppBundle\CSL;


class Text extends Format
{
    public $source;
    protected $var;

    function init(\DOMElement $dom_node, CiteProc $citeproc)
    {
        foreach (array('variable', 'macro', 'term', 'value') as $attr) {
            if ($dom_node->hasAttribute($attr)) {
                $this->source = $attr;
                if ($this->source == 'macro') {
                    $this->var = str_replace(' ', '_', $dom_node->getAttribute($attr));
                } else {
                    $this->var = $dom_node->getAttribute($attr);
                }
            }
        }
    }

    function init_formatting()
    {
//    if ($this->variable == 'title') {
//      $this->span_class = 'title';
//    }
        parent::init_formatting();

    }

    function render($data = null, $mode = null)
    {
        $text = '';
        if (in_array($this->var, $this->citeproc->quash)) {
            return;
        }

        switch ($this->source) {
            case 'variable':
                if (!isset($data->{$this->variable}) || empty($data->{$this->variable})) {
                    return;
                }
                $text = $data->{$this->variable}; //$this->data[$this->var];  // include the contents of a variable
                break;
            case 'macro':
                $macro = $this->var;
                $text = $this->citeproc->render_macro($macro, $data, $mode); //trigger the macro process
                break;
            case 'term':
                $form = (($form = $this->form)) ? $form : '';
                $text = $this->citeproc->get_locale('term', $this->var, $form);
                break;
            case 'value':
                $text = $this->var; //$this->var;  // dump the text verbatim
                break;
        }

        if (empty($text)) {
            return;
        }

        return $this->format($text);
    }
}