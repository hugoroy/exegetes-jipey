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
    protected $type;

    /**
     * @var mixed
     * @Assert\NotNull()
     */
    protected $id;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $journalAbbreviation;

    /**
     * @var string
     */
    protected $shortTitle;

    /**
     * @var Name[]
     */
    protected $author;

    /**
     * @var Name[]
     */
    protected $collectionEditor;
    /**
     * @var Name[]
     */
    protected $composer;
    /**
     * @var Name[]
     */
    protected $containerAuthor;
    /**
     * @var Name[]
     */
    protected $director;
    /**
     * @var Name[]
     */
    protected $editor;
    /**
     * @var Name[]
     */
    protected $editorialDirector;
    /**
     * @var Name[]
     */
    protected $interviewer;
    /**
     * @var Name[]
     */
    protected $illustrator;
    /**
     * @var Name[]
     */
    protected $originalAuthor;
    /**
     * @var Name[]
     */
    protected $recipient;
    /**
     * @var Name[]
     */
    protected $reviewedAuthor;
    /**
     * @var Name[]
     */
    protected $translator;

    /**
     * @var Date
     */
    protected $accessed;

    /**
     * @var Date
     */
    protected $container;

    /**
     * @var Date
     */
    protected $eventDate;

    /**
     * @var Date
     */
    protected $issued;

    /**
     * @var Date
     */
    protected $originalDate;

    /**
     * @var Date
     */
    protected $submitted;

    /**
     * @var string
     */
    protected $abstract;

    /**
     * @var string
     */
    protected $annote;

    /**
     * @var string
     */
    protected $archive;

    /**
     * @var string
     */
    protected $archiveLocation;

    /**
     * @var string
     */
    protected $archivePlace;

    /**
     * @var string
     */
    protected $authority;

    /**
     * @var string
     */
    protected $callNumber;

    /**
     * @var string
     */
    protected $chapterNumber;

    /**
     * @var string
     */
    protected $citationNumber;

    /**
     * @var string
     */
    protected $citationLabel;

    /**
     * @var string
     */
    protected $collectionNumber;

    /**
     * @var string
     */
    protected $collectionTitle;

    /**
     * @var string
     */
    protected $containerTitle;

    /**
     * @var string
     */
    protected $containerTitlePart;

    /**
     * @var string
     */
    protected $dimensions;

    /**
     * @var string
     */
    protected $DOI;

    /**
     * @var string
     */
    protected $edition;

    /**
     * @var string
     */
    protected $event;

    /**
     * @var string
     */
    protected $eventPlace;

    /**
     * @var string
     */
    protected $firstReferenceNoteNumber;

    /**
     * @var string
     */
    protected $genre;

    /**
     * @var string
     */
    protected $ISBN;

    /**
     * @var string
     */
    protected $ISSN;

    /**
     * @var string
     */
    protected $issue;

    /**
     * @var string
     */
    protected $jurisdiction;

    /**
     * @var string
     */
    protected $keyword;

    /**
     * @var string
     */
    protected $locator;

    /**
     * @var string
     */
    protected $medium;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $numberOfPages;

    /**
     * @var string
     */
    protected $numberOfVolumes;

    /**
     * @var string
     */
    protected $originalPublisher;

    /**
     * @var string
     */
    protected $originalPublisherPlace;

    /**
     * @var string
     */
    protected $originalTitle;

    /**
     * @var string
     */
    protected $page;

    /**
     * @var string
     */
    protected $pageFirst;

    /**
     * @var string
     */
    protected $PMCID;

    /**
     * @var string
     */
    protected $PMID;

    /**
     * @var string
     */
    protected $publisher;

    /**
     * @var string
     */
    protected $publisherPlace;

    /**
     * @var string
     */
    protected $references;

    /**
     * @var string
     */
    protected $reviewedTitle;

    /**
     * @var string
     */
    protected $scale;

    /**
     * @var string
     */
    protected $section;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $titleShort;

    /**
     * @var string
     */
    protected $URL;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $volume;

    /**
     * @var string
     */
    protected $yearSuffix;
}