<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 16:17
 */

namespace AppBundle\CSL;


class DatePart extends Format
{

    function render($date, $mode = null)
    {
        $text = '';

        switch ($this->name) {
            case 'year':
                $text = (isset($date[0])) ? $date[0] : '';
                if ($text > 0 && $text < 500) {
                    $text = $text.$this->citeproc->get_locale('term', 'ad');
                } elseif ($text < 0) {
                    $text = $text * -1;
                    $text = $text.$this->citeproc->get_locale('term', 'bc');
                }
                //return ((isset($this->prefix))? $this->prefix : '') . $date[0] . ((isset($this->suffix))? $this->suffix : '');
                break;
            case 'month':
                $text = (isset($date[1])) ? $date[1] : '';
                if (empty($text) || $text < 1 || $text > 12) {
                    return;
                }
                // $form = $this->form;
                switch ($this->form) {
                    case 'numeric':
                        break;
                    case 'numeric-leading-zeros':
                        if ($text < 10) {
                            $text = '0'.$text;
                            break;
                        }
                        break;
                    case 'short':
                        $month = 'month-'.sprintf('%02d', $text);
                        $text = $this->citeproc->get_locale('term', $month, 'short');
                        break;
                    default:
                        $month = 'month-'.sprintf('%02d', $text);
                        $text = $this->citeproc->get_locale('term', $month);
                        break;
                }
                break;
            case 'day':
                $text = (isset($date[2])) ? $date[2] : '';
                break;
        }

        return $this->format($text);
    }
}