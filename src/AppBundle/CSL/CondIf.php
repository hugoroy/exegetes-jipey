<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:23
 */

namespace AppBundle\CSL;


class CondIf extends RenderingElement
{

    function evaluate($data)
    {
        $match = (($match = $this->match)) ? $match : 'all';
        if (($types = $this->type)) {
            $types = explode(' ', $types);
            $matches = 0;
            foreach ($types as $type) {
                if (isset($data->type)) {
                    if ($data->type == $type && $match == 'any') {
                        return true;
                    }
                    if ($data->type != $type && $match == 'all') {
                        return false;
                    }
                    if ($data->type == $type) {
                        $matches++;
                    }
                }
            }
            if ($match == 'all' && $matches == count($types)) {
                return true;
            }
            if ($match == 'none' && $matches == 0) {
                return true;
            }

            return false;
        }
        if (($variables = $this->variable)) {
            $variables = explode(' ', $variables);
            $matches = 0;
            foreach ($variables as $var) {
                if (isset($data->$var) && !empty($data->$var) && $match == 'any') {
                    return true;
                }
                if ((!isset($data->$var) || empty($data->$var)) && $match == 'all') {
                    return false;
                }
                if (isset($data->$var) && !empty($data->$var)) {
                    $matches++;
                }
            }
            if ($match == 'all' && $matches == count($variables)) {
                return true;
            }
            if ($match == 'none' && $matches == 0) {
                return true;
            }

            return false;
        }
        if (($is_numeric = $this->{'is-numeric'})) {
            $variables = explode(' ', $is_numeric);
            $matches = 0;
            foreach ($variables as $var) {
                if (isset($data->$var)) {
                    if (is_numeric($data->$var) && $match == 'any') {
                        return true;
                    }
                    if (!is_numeric($data->$var)) {
                        if (preg_match('/(?:^\d+|\d+$)/', $data->$var)) {
                            $matches++;
                        } elseif ($match == 'all') {
                            return false;
                        }
                    }
                    if (is_numeric($data->$var)) {
                        $matches++;
                    }
                }
            }
            if ($match == 'all' && $matches == count($variables)) {
                return true;
            }
            if ($match == 'none' && $matches == 0) {
                return true;
            }

            return false;
        }
        if (isset($this->locator)) {
            $test = explode(' ', $this->type);
        }

        return false;
    }
}