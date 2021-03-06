<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:19
 */

namespace AppBundle\CSL;


class Label extends Format
{
    private $plural;

    function render($data, $mode = null)
    {
        $text = '';

        $variables = explode(' ', $this->variable);
        $form = (($form = $this->form)) ? $form : 'long';
        switch ($this->plural) {
            case 'never':
                $plural = 'single';
                break;
            case 'always':
                $plural = 'multiple';
                break;
            case 'contextual':
            default:
        }
        foreach ($variables as $variable) {
            if (isset($data->{$variable})) {
                if (!isset($this->plural) && empty($plural) && is_array($data->{$variable})) {
                    $count = count($data->{$variable});
                    if ($count == 1) {
                        $plural = 'single';
                    } elseif ($count > 1) {
                        $plural = 'multiple';
                    }
                } else {
                    $plural = $this->evaluateStringPluralism($data, $variable);
                }
                if (($term = $this->citeproc->get_locale('term', $variable, $form, $plural))) {
                    $text = $term;
                    break;
                }
            }
        }

        if (empty($text)) {
            return;
        }
        if ($this->{'strip-periods'}) {
            $text = str_replace('.', '', $text);
        }

        return $this->format($text);
    }

    function evaluateStringPluralism($data, $variable)
    {
        $str = $data->{$variable};
        $plural = 'single';

        if (!empty($str)) {
//      $regex = '/(?:[0-9],\s*[0-9]|\s+and\s+|&|([0-9]+)\s*[\-\x2013]\s*([0-9]+))/';
            switch ($variable) {
                case 'page':
                    $page_regex = "/([a-zA-Z]*)([0-9]+)\s*(?:–|-)\s*([a-zA-Z]*)([0-9]+)/";
                    $err = preg_match($page_regex, $str, $m);
                    if ($err !== false && count($m) == 0) {
                        $plural = 'single';
                    } elseif ($err !== false && count($m)) {
                        $plural = 'multiple';
                    }
                    break;
                default:
            }
        }

        return $plural;
    }
}