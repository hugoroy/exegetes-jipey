<?php

namespace AppBundle\CSL;

/**
 *   CiteProc-PHP
 *
 *   Copyright (C) 2010 - 2011  Ron Jerome, all rights reserved
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
class CiteProc
{
    /**
     * @var Bibliography
     */
    public $bibliography;

    /**
     * @var Citation
     */
    public $citation;

    /**
     * @var Style
     */
    public $style;

    /**
     * @var Macros
     */
    protected $macros;

    /**
     * @var Info
     */
    private $info;

    /**
     * @var Locale
     */
    protected $locale;

    protected $style_locale;

    /**
     * @var array
     */
    public $quash;

    /**
     * @var Mapper
     */
    private $mapper = null;

    function __construct($csl = null, $lang = 'en')
    {
        if ($csl) {
            $this->init($csl, $lang);
        }
    }

    function init($csl_doc, $lang)
    {
        // define field values appropriate to your data in the Mapper class and un-comment the next line.
        $this->mapper = new Mapper();
        $this->quash  = array();


        $style_nodes = $csl_doc['style'];
        if ($style_nodes) {
            foreach ($style_nodes as $style) {
                $this->style = new Style($style);
            }
        }

        $info_nodes = $csl_doc['info'];
        if ($info_nodes) {
            foreach ($info_nodes as $info) {
                $this->info = new Info($info);
            }
        }

        $this->locale = new Locale($lang);
        $this->locale->set_style_locale($csl_doc);


        $macro_nodes = $csl_doc['macro'];
        if ($macro_nodes) {
            $this->macros = new Macros($macro_nodes, $this);
        }

        $citation_nodes = $csl_doc['citation'];
        foreach ($citation_nodes as $citation) {
            $this->citation = new Citation($citation, $this);
        }

        $bibliography_nodes = $csl_doc['bibliography'];
        foreach ($bibliography_nodes as $bibliography) {
            $this->bibliography = new Bibliography($bibliography, $this);
        }

    }

    function render($data, $mode = null)
    {
        $text = '';
        switch ($mode) {
            case 'citation':
                $text .= (isset($this->citation)) ? $this->citation->render($data) : '';
                break;
            case  'bibliography':
            default:
                $text .= (isset($this->bibliography)) ? $this->bibliography->render($data) : '';
                break;
        }

        return $text;
    }

    function render_macro($name, $data, $mode)
    {
        return $this->macros->render_macro($name, $data, $mode);
    }

    function get_locale($type, $arg1, $arg2 = null, $arg3 = null)
    {
        return $this->locale->get_locale($type, $arg1, $arg2, $arg3);
    }

    function map_field($field)
    {
        if ($this->mapper) {
            return $this->mapper->map_field($field);
        }

        return ($field);
    }

    function map_type($field)
    {
        if ($this->mapper) {
            return $this->mapper->map_type($field);
        }

        return ($field);
    }
}



























































