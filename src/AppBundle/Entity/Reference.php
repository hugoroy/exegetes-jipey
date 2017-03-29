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

    protected $container;

    protected $eventDate;

    protected $issued;

    protected $originalDate;

    protected $submitted;

    protected $abstract;

    protected $annote;

    protected $archive;

    protected $archiveLocation;

    protected $archivePlace;

    protected $authority;

    protected $callNumber;

    protected $chapterNumber;
}