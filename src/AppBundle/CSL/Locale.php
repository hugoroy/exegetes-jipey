<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 28/03/2017
 * Time: 17:21
 */

namespace AppBundle\CSL;


class Locale
{
    protected $locale_xmlstring = null;
    protected $style_locale_xmlstring = null;
    protected $locale = null;
    protected $style_locale = null;
    private $module_path;

    function __construct($lang = 'en')
    {
        $this->module_path = dirname(__FILE__);
        $this->locale = new \SimpleXMLElement($this->get_locales_file_name($lang));
        if ($this->locale) {
            $this->locale->registerXPathNamespace('cs', 'http://purl.org/net/xbiblio/csl');
        }
    }

    // SimpleXML objects cannot be serialized, so we must convert to an XML string prior to serialization
    function __sleep()
    {
        $this->locale_xmlstring = ($this->locale) ? $this->locale->asXML() : '';
        $this->style_locale_xmlstring = ($this->style_locale) ? $this->style_locale->asXML() : '';

        return array('locale_xmlstring', 'style_locale_xmlstring');
    }

    // SimpleXML objects cannot be serialized, so when un-serializing them, they must rebuild from the serialized XML string.
    function __wakeup()
    {
        $this->style_locale = (!empty($this->style_locale_xmlstring)) ? new \SimpleXMLElement(
            $this->style_locale_xmlstring
        ) : null;
        $this->locale = (!empty($this->locale_xmlstring)) ? new \SimpleXMLElement($this->locale_xmlstring) : null;
        if ($this->locale) {
            $this->locale->registerXPathNamespace('cs', 'http://purl.org/net/xbiblio/csl');
        }
    }

    function get_locales_file_name($lang)
    {
        $lang_bases = array(
            "af" => "af-ZA",
            "ar" => "ar-AR",
            "bg" => "bg-BG",
            "ca" => "ca-AD",
            "cs" => "cs-CZ",
            "da" => "da-DK",
            "de" => "de-DE",
            "el" => "el-GR",
            "en" => "en-GB",
            "en" => "en-US",
            "es" => "es-ES",
            "et" => "et-EE",
            "fa" => "fa-IR",
            "fi" => "fi-FI",
            "fr" => "fr-FR",
            "he" => "he-IL",
            "hu" => "hu-HU",
            "is" => "is-IS",
            "it" => "it-IT",
            "ja" => "ja-JP",
            "km" => "km-KH",
            "ko" => "ko-KR",
            "mn" => "mn-MN",
            "nb" => "nb-NO",
            "nl" => "nl-NL",
            "nn" => "nn-NO",
            "pl" => "pl-PL",
            "pt" => "pt-PT",
            "ro" => "ro-RO",
            "ru" => "ru-RU",
            "sk" => "sk-SK",
            "sl" => "sl-SI",
            "sr" => "sr-RS",
            "sv" => "sv-SE",
            "th" => "th-TH",
            "tr" => "tr-TR",
            "uk" => "uk-UA",
            "vi" => "vi-VN",
            "zh" => "zh-CN",
        );

        return (isset($lang_bases[$lang])) ? file_get_contents(
            $this->module_path.'/locale/locales-'.$lang_bases[$lang].'.xml'
        ) : file_get_contents($this->module_path.'/locale/locales-en-US.xml');
    }

    function get_locale($type, $arg1, $arg2 = null, $arg3 = null)
    {
        switch ($type) {
            case 'term':
                $term = '';
                $form = $arg2 ? " and @form='$arg2'" : '';
                $plural = $arg3 ? "/cs:$arg3" : '';
                $local_plural = $arg3 ? "/$arg3" : '';
                if ($arg2 == 'verb' || $arg2 == 'verb-short') {
                    $plural = '';
                }
                if ($this->style_locale) {
                    $term = @$this->style_locale->xpath(
                        "//locale[@xml:lang='en']/terms/term[@name='$arg1'$form]$plural"
                    );
                    if (!$term) {
                        $term = @$this->style_locale->xpath("//locale/terms/term[@name='$arg1'$form]/$local_plural");
                    }
                }
                if (!$term) {
                    $term = $this->locale->xpath("//cs:term[@name='$arg1'$form]$plural");
                }
                if (isset($term[0])) {
                    if (isset($arg3) && isset($term[0]->{$arg3})) {
                        return (string)$term[0]->{$arg3};
                    }
                    if (!isset($arg3) && isset($term[0]->single)) {
                        return (string)$term[0]->single;
                    }

                    return (string)$term[0];
                }
                break;
            case 'date_option':
                $attribs = array();
                if ($this->style_locale) {
                    $date_part = $this->style_locale->xpath("//date[@form='$arg1']/date-part[@name='$arg2']");
                }
                if (!isset($date_part)) {
                    $date_part = $this->locale->xpath("//cs:date[@form='$arg1']/cs:date-part[@name='$arg2']");
                }
                if (isset($date_part)) {
                    foreach ($$date_part->attributes() as $name => $value) {
                        $attribs[$name] = (string)$value;
                    }
                }

                return $attribs;
                break;
            case 'date_options':
                $options = array();
                if ($this->style_locale) {
                    $options = $this->style_locale->xpath("//locale[@xml:lang='en']/date[@form='$arg1']");
                    if (!$options) {
                        $options = $this->style_locale->xpath("//locale/date[@form='$arg1']");
                    }
                }
                if (!$options) {
                    $options = $this->locale->xpath("//cs:date[@form='$arg1']");
                }
                if (isset($options[0])) {
                    return $options[0];
                }
                break;
            case 'style_option':
                $attribs = array();
                if ($this->style_locale) {
                    $option = $this->style_locale->xpath("//locale[@xml:lang='en']/style-options[@$arg1]");
                    if (!$option) {
                        $option = $this->style_locale->xpath("//locale/style-options[@$arg1]");
                    }
                }
                if (isset($option) && !empty($option)) {
                    $attribs = $option[0]->attributes();
                }
                if (empty($attribs)) {
                    $option = $this->locale->xpath("//cs:style-options[@$arg1]");
                }
                foreach ($option[0]->attributes() as $name => $value) {
                    if ($name == $arg1) {
                        return (string)$value;
                    }
                }
                break;
        }
    }

    public function set_style_locale($csl_doc)
    {
        $xml = '';
        $locale_nodes = $csl_doc->getElementsByTagName('locale');
        if ($locale_nodes) {
            $xml_open = '<style-locale>';
            $xml_close = '</style-locale>';
            foreach ($locale_nodes as $key => $locale_node) {
                $xml .= $csl_doc->saveXML($locale_node);
            }
            if (!empty($xml)) {
                $this->style_locale = new \SimpleXMLElement($xml_open.$xml.$xml_close);
            }
        }
    }

}