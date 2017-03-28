<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:17
 */

namespace AppBundle\CSL;


class Date extends Format
{

    function init(\DOMElement $dom_node, CiteProc $citeproc)
    {
        $locale_elements = array();

        if ($form = $this->form) {
            $local_date = $this->citeproc->get_locale('date_options', $form);
            $dom_elem = dom_import_simplexml($local_date[0]);
            if ($dom_elem) {
                foreach ($dom_elem->childNodes as $node) {
                    if ($node->nodeType == 1) {
                        $locale_elements[] = Factory::create($node, $citeproc);
                    }
                }
            }
            foreach ($dom_node->childNodes as $node) {
                if ($node->nodeType == 1) {
                    $element = Factory::create($node, $citeproc);

                    foreach ($locale_elements as $key => $locale_element) {
                        if ($locale_element->name == $element->name) {
                            $locale_elements[$key]->attributes = array_merge(
                                $locale_element->attributes,
                                $element->attributes
                            );
                            $locale_elements[$key]->format = $element->format;
                            break;
                        } else {
                            $locale_elements[] = $element;
                        }
                    }
                }
            }
            if ($date_parts = $this->{'date-parts'}) {
                $parts = explode('-', $date_parts);
                foreach ($locale_elements as $key => $element) {
                    if (array_search($element->name, $parts) === false) {
                        unset($locale_elements[$key]);
                    }
                }
                if (count($locale_elements) != count($parts)) {
                    foreach ($parts as $part) {
                        $element = new DatePart();
                        $element->name = $part;
                        $locale_elements[] = $element;
                    }
                }
                // now re-order the elements
                foreach ($parts as $part) {
                    foreach ($locale_elements as $key => $element) {
                        if ($element->name == $part) {
                            $this->elements[] = $element;
                            unset($locale_elements[$key]);
                        }
                    }
                }

            } else {
                $this->elements = $locale_elements;
            }
        } else {
            parent::init($dom_node, $citeproc);
        }


    }

    function render($data, $mode = null)
    {
        $date_parts = array();
        $date = '';
        $text = '';

        if (($var = $this->variable) && isset($data->{$var})) {
            $date = $data->{$var}->{'date-parts'}[0];
            foreach ($this->elements as $element) {
                $date_parts[] = $element->render($date, $mode);
            }
            $text = implode('', $date_parts);
        }

        return $this->format($text);
    }
}