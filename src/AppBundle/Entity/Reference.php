<?php
/**
 * Created by PhpStorm.
 * User: loconox
 * Date: 29/03/2017
 * Time: 14:55
 */

namespace AppBundle\Entity;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Reference
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ReferenceManger")
 * @UniqueEntity(fields={"id"})
 */
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
     * @ORM\Column(type="string")
     */
    public $type;

    /**
     * @var string
     * @Assert\NotNull()
     * @ORM\Column(type="string")
     * @ORM\Id()
     */
    public $id;

    /**
     * @var array|null
     */
    public $categories;

    /**
     * @var string|null
     */
    public $language;

    /**
     * @var string|null
     */
    public $journalAbbreviation;

    /**
     * @var string|null
     */
    public $shortTitle;

    /**
     * @var Name[]|null
     */
    public $author;

    /**
     * @var Name[]|null
     */
    public $collectionEditor;
    /**
     * @var Name[]|null
     */
    public $composer;
    /**
     * @var Name[]|null
     */
    public $containerAuthor;
    /**
     * @var Name[]|null
     */
    public $director;
    /**
     * @var Name[]|null
     */
    public $editor;
    /**
     * @var Name[]|null
     */
    public $editorialDirector;
    /**
     * @var Name[]|null
     */
    public $interviewer;
    /**
     * @var Name[]|null
     */
    public $illustrator;
    /**
     * @var Name[]|null
     */
    public $originalAuthor;
    /**
     * @var Name[]|null
     */
    public $recipient;
    /**
     * @var Name[]|null
     */
    public $reviewedAuthor;
    /**
     * @var Name[]|null
     */
    public $translator;

    /**
     * @var Date|null
     */
    public $accessed;

    /**
     * @var Date|null
     */
    public $container;

    /**
     * @var Date|null
     */
    public $eventDate;

    /**
     * @var Date
     * @ORM\Column(type="date")
     */
    public $issued;

    /**
     * @var Date|null
     */
    public $originalDate;

    /**
     * @var Date|null
     */
    public $submitted;

    /**
     * @var string|null
     */
    public $abstract;

    /**
     * @var string|null
     */
    public $annote;

    /**
     * @var string|null
     */
    public $archive;

    /**
     * @var string|null
     */
    public $archiveLocation;

    /**
     * @var string|null
     */
    public $archivePlace;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    public $authority;

    /**
     * @var string|null
     */
    public $callNumber;

    /**
     * @var string|null
     */
    public $chapterNumber;

    /**
     * @var string|null
     */
    public $citationNumber;

    /**
     * @var string|null
     */
    public $citationLabel;

    /**
     * @var string|null
     */
    public $collectionNumber;

    /**
     * @var string|null
     */
    public $collectionTitle;

    /**
     * @var string|null
     */
    public $containerTitle;

    /**
     * @var string|null
     */
    public $containerTitlePart;

    /**
     * @var string|null
     */
    public $dimensions;

    /**
     * @var string|null
     */
    public $DOI;

    /**
     * @var string|null
     */
    public $edition;

    /**
     * @var string|null
     */
    public $event;

    /**
     * @var string|null
     */
    public $eventPlace;

    /**
     * @var string|null
     */
    public $firstReferenceNoteNumber;

    /**
     * @var string|null
     */
    public $genre;

    /**
     * @var string|null
     */
    public $ISBN;

    /**
     * @var string|null
     */
    public $ISSN;

    /**
     * @var string|null
     */
    public $issue;

    /**
     * @var string|null
     */
    public $jurisdiction;

    /**
     * @var string|null
     */
    public $keyword;

    /**
     * @var string|null
     */
    public $locator;

    /**
     * @var string|null
     */
    public $medium;

    /**
     * @var string|null
     */
    public $note;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    public $number;

    /**
     * @var string|null
     */
    public $numberOfPages;

    /**
     * @var string|null
     */
    public $numberOfVolumes;

    /**
     * @var string|null
     */
    public $originalPublisher;

    /**
     * @var string|null
     */
    public $originalPublisherPlace;

    /**
     * @var string|null
     */
    public $originalTitle;

    /**
     * @var string|null
     */
    public $page;

    /**
     * @var string|null
     */
    public $pageFirst;

    /**
     * @var string|null
     */
    public $PMCID;

    /**
     * @var string|null
     */
    public $PMID;

    /**
     * @var string|null
     */
    public $publisher;

    /**
     * @var string|null
     */
    public $publisherPlace;

    /**
     * @var string|null
     */
    public $references;

    /**
     * @var string|null
     */
    public $reviewedTitle;

    /**
     * @var string|null
     */
    public $scale;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    public $section;

    /**
     * @var string|null
     */
    public $source;

    /**
     * @var string|null
     */
    public $status;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    public $title;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    public $titleShort;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    public $URL;

    /**
     * @var string|null
     */
    public $version;

    /**
     * @var string|null
     */
    public $volume;

    /**
     * @var string|null
     */
    public $yearSuffix;

    /*
     * None CSL fields
     */

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    public $ECLI;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    public $comments;

    public function __construct()
    {
        $this->type = 'legal_case';
        $this->issued = new \DateTime('now');
    }

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