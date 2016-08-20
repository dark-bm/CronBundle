<?php
namespace ColourStream\Bundle\CronBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ColourStream\Bundle\CronBundle\Entity\CronJobRepository")
 */
class CronJob
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer $id
     */
    protected $id;
    
    /**
     * @ORM\Column
     * @var string $command
     */
    protected $command;
    /**
     * @ORM\Column
     * @var string $description
     */
    protected $description;

    /**
     * @ORM\Column(name="job_interval", type="string", length=40)
     * @var string $interval
     */
    protected $interval;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime $nextRun
     */
    protected $nextRun;
    /**
     * @ORM\Column(type="boolean")
     * @var boolean $enabled
     */
    protected $enabled;
    
    /**
     * @ORM\OneToMany(targetEntity="CronJobResult", mappedBy="job", cascade={"remove"})
     * @var ArrayCollection
     */
    protected $results;
    /**
     * @ORM\OneToOne(targetEntity="CronJobResult",cascade={"persist"})
     * @var CronJobResult
     */
    protected $mostRecentRun;

    public function __construct()
    {
        $this->results = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set command
     *
     * @param string $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * Get command
     *
     * @return string 
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set interval
     *
     * @param string $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * Get interval
     *
     * @return string 
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set nextRun
     *
     * @param \DateTime $nextRun
     */
    public function setNextRun($nextRun)
    {
        $this->nextRun = $nextRun;
    }

    /**
     * Get nextRun
     *
     * @return \DateTime
     */
    public function getNextRun()
    {
        return $this->nextRun;
    }

    /**
     * Add results
     *
     * @param CronJobResult $results
     */
    public function addCronJobResult(CronJobResult $results)
    {
        $results->setJob($this);
        $this->results[] = $results;
    }

    /**
     * Get results
     *
     * @return Collection
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set mostRecentRun
     *
     * @param CronJobResult $mostRecentRun
     */
    public function setMostRecentRun(CronJobResult $mostRecentRun)
    {
        $mostRecentRun->setJob($this);
        $this->mostRecentRun = $mostRecentRun;
    }

    /**
     * Get mostRecentRun
     *
     * @return CronJobResult
     */
    public function getMostRecentRun()
    {
        return $this->mostRecentRun;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    public function __toString()
    {
        return $this->command;
    }

}
