<?php

namespace Admingenerator\DoctrineOrmDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="s2a_demo_doctrine_orm_post")
 * @ORM\Entity
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Assert\NotNull()
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt;
    
    /**
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * @Assert\Length(max = "32")
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $author;
    
    /**
     * @Assert\NotNull()
     * @Assert\Type(type="string")
     * @Assert\Length(max = "64")
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    protected $title;
    
    /**
     * @Assert\NotNull()
     * @ORM\Column(type="text", nullable=false)
     */
    protected $content;
    
    /**
     * @Assert\Type(type="boolean")
     * @ORM\Column(type="boolean")
     */
    protected $isPublished;
    
    /**
     * @Assert\File(maxSize="6000000")
     * @Assert\File(mimeTypes = {"image/jpeg", "image/png"})
     * @Vich\UploadableField(mapping="doctrine_orm_blog_post_thumb", fileNameProperty="thumbPath")
     */
    protected $thumbFile;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $thumbPath;

    /**
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="Admingenerator\DoctrineOrmDemoBundle\Entity\Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToMany(targetEntity="Admingenerator\DoctrineOrmDemoBundle\Entity\Tag")
     * @ORM\JoinTable(name="s2a_demo_doctrine_orm_m2m_post_tag",
     *    joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     */
    protected $tags;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Post
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set thumbPath
     *
     * @param string $thumbPath
     * @return Post
     */
    public function setThumbPath($thumbPath)
    {
        $this->thumbPath = $thumbPath;

        return $this;
    }

    /**
     * Get thumbPath
     *
     * @return string 
     */
    public function getThumbPath()
    {
        return $this->thumbPath;
    }

    /**
     * Set category
     *
     * @param \Admingenerator\DoctrineOrmDemoBundle\Entity\Category $category
     * @return Post
     */
    public function setCategory(\Admingenerator\DoctrineOrmDemoBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Admingenerator\DoctrineOrmDemoBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add tag
     *
     * @param \Admingenerator\DoctrineOrmDemoBundle\Entity\Tag $tag
     * @return Post
     */
    public function addTag(\Admingenerator\DoctrineOrmDemoBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Admingenerator\DoctrineOrmDemoBundle\Entity\Tag $tag
     */
    public function removeTag(\Admingenerator\DoctrineOrmDemoBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
