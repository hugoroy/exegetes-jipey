<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 29/03/2017
 * Time: 14:55
 */

namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class Reference
{
    /**
     * @var string
     * @Assert\NotNull()
     * @Assert\Choice(choices={
     *     "article",
     *     "article-journal",
     *     "article-magazine",
     *     "article-newspaper",
     *     "bill",
     *     "book",
     *     "broadcast",
     *     "chapter",
     *     "dataset",
     *     "entry",
     *     "entry-dictionary",
     *     "entry-encyclopedia",
     *     "figure",
     *     "graphic",
     *     "interview",
     *     "legal_case",
     *     "legislation",
     *     "manuscript",
     *     "map",
     *     "motion_picture",
     *     "musical_score",
     *     "pamphlet",
     *     "paper-conference",
     *     "patent",
     *     "personal_communication",
     *     "post",
     *     "post-weblog",
     *     "report",
     *     "review",
     *     "review-book",
     *     "song",
     *     "speech",
     *     "thesis",
     *     "treaty",
     *     "webpage"})
     */
    public $type;

    /**
     * @var mixed
     * @Assert\NotNull()
     */
    public $id;

    /**
     * @var array
     */
    public $categories;

    /**
     * @var string
     */
    public $language;

    /**
     * @var string
     */
    public $journalAbbreviation;

    /**
     * @var string
     */
    public $shortTitle;

    /**
     * @var Name[]
     */
    public $author;

    /**
     * @var Name[]
     */
    public $collectionEditor;
    /**
     * @var Name[]
     */
    public $composer;
    /**
     * @var Name[]
     */
    public $containerAuthor;
    /**
     * @var Name[]
     */
    public $director;
    /**
     * @var Name[]
     */
    public $editor;
    /**
     * @var Name[]
     */
    public $editorialDirector;
    /**
     * @var Name[]
     */
    public $interviewer;
    /**
     * @var Name[]
     */
    public $illustrator;
    /**
     * @var Name[]
     */
    public $originalAuthor;
    /**
     * @var Name[]
     */
    public $recipient;
    /**
     * @var Name[]
     */
    public $reviewedAuthor;
    /**
     * @var Name[]
     */
    public $translator;

    /**
     * @var Date
     */
    public $accessed;

    /**
     * @var Date
     */
    public $container;

    /**
     * @var Date
     */
    public $eventDate;

    /**
     * @var Date
     */
    public $issued;

    /**
     * @var Date
     */
    public $originalDate;

    /**
     * @var Date
     */
    public $submitted;

    /**
     * @var string
     */
    public $abstract;

    /**
     * @var string
     */
    public $annote;

    /**
     * @var string
     */
    public $archive;

    /**
     * @var string
     */
    public $archiveLocation;

    /**
     * @var string
     */
    public $archivePlace;

    /**
     * @var string
     */
    public $authority;

    /**
     * @var string
     */
    public $callNumber;

    /**
     * @var string
     */
    public $chapterNumber;

    /**
     * @var string
     */
    public $citationNumber;

    /**
     * @var string
     */
    public $citationLabel;

    /**
     * @var string
     */
    public $collectionNumber;

    /**
     * @var string
     */
    public $collectionTitle;

    /**
     * @var string
     */
    public $containerTitle;

    /**
     * @var string
     */
    public $containerTitlePart;

    /**
     * @var string
     */
    public $dimensions;

    /**
     * @var string
     */
    public $DOI;

    /**
     * @var string
     */
    public $edition;

    /**
     * @var string
     */
    public $event;

    /**
     * @var string
     */
    public $eventPlace;

    /**
     * @var string
     */
    public $firstReferenceNoteNumber;

    /**
     * @var string
     */
    public $genre;

    /**
     * @var string
     */
    public $ISBN;

    /**
     * @var string
     */
    public $ISSN;

    /**
     * @var string
     */
    public $issue;

    /**
     * @var string
     */
    public $jurisdiction;

    /**
     * @var string
     */
    public $keyword;

    /**
     * @var string
     */
    public $locator;

    /**
     * @var string
     */
    public $medium;

    /**
     * @var string
     */
    public $note;

    /**
     * @var string
     */
    public $number;

    /**
     * @var string
     */
    public $numberOfPages;

    /**
     * @var string
     */
    public $numberOfVolumes;

    /**
     * @var string
     */
    public $originalPublisher;

    /**
     * @var string
     */
    public $originalPublisherPlace;

    /**
     * @var string
     */
    public $originalTitle;

    /**
     * @var string
     */
    public $page;

    /**
     * @var string
     */
    public $pageFirst;

    /**
     * @var string
     */
    public $PMCID;

    /**
     * @var string
     */
    public $PMID;

    /**
     * @var string
     */
    public $publisher;

    /**
     * @var string
     */
    public $publisherPlace;

    /**
     * @var string
     */
    public $references;

    /**
     * @var string
     */
    public $reviewedTitle;

    /**
     * @var string
     */
    public $scale;

    /**
     * @var string
     */
    public $section;

    /**
     * @var string
     */
    public $source;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $titleShort;

    /**
     * @var string
     */
    public $URL;

    /**
     * @var string
     */
    public $version;

    /**
     * @var string
     */
    public $volume;

    /**
     * @var string
     */
    public $yearSuffix;

    /*
     * None CSL fields
     */

    /**
     * @var string
     */
    public $ECLI;

    /**
     * @var string
     */
    public $comments;

    public static function getTypeChoices()
    {
        return [
            "article",
            "article-journal",
            "article-magazine",
            "article-newspaper",
            "bill",
            "book",
            "broadcast",
            "chapter",
            "dataset",
            "entry",
            "entry-dictionary",
            "entry-encyclopedia",
            "figure",
            "graphic",
            "interview",
            "legal_case",
            "legislation",
            "manuscript",
            "map",
            "motion_picture",
            "musical_score",
            "pamphlet",
            "paper-conference",
            "patent",
            "personal_communication",
            "post",
            "post-weblog",
            "report",
            "review",
            "review-book",
            "song",
            "speech",
            "thesis",
            "treaty",
            "webpage",
        ];
    }
}